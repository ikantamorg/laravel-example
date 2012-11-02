<?php

namespace Repository;

use Str;
use DB;

abstract class Base
{
	protected $_filter = [];
	protected $_eager_loads = [];

	public function filter($params = [])
	{
		$this->_filter = $params;
		return $this;
	}

	public function reset()
	{
		$this->_filter = [];
	}

	public function add_favorited_by_user_constraint($q, $user)
	{
		if(! $user )
			return $q;

		if(! $tagable = $q->model->tagable )
			return $q;

		$singular = Str::singular($tagable->slug);

		$fav_table = 'core_user_favorite_'.$tagable->slug;

		$q = $q->join($fav_table, $fav_table.".{$singular}_id", '=', $q->model->table().'.id')
			   ->where($fav_table.'.user_id', '=', $user->id);

		return $q;
	}

	public function add_tag_constraints($q, $tags)
	{
		if( ! $tags )
			return $q;

		if(! $tagable = $q->model->tagable )
			return $q;

		$singular = Str::singular($tagable->slug);

		$junction = 'core_tag_'.$singular;

		$q = $q->join($junction, $junction.".{$singular}_id", '=', $q->model->table().'.id')
			   ->join('core_tags', $junction.'.tag_id', '=', 'core_tags.id')
			   ->where_in('core_tags.slug', $tags)
			   ->group_by("{$junction}.{$singular}_id")
			   ->having(DB::raw("count(`{$junction}`.`tag_id`)"), '>=', count($tags));
		
		return $q;
	}

	protected function eager_load($q)
	{
		$q->model->includes = $this->includes();
		return $q;
	}
}