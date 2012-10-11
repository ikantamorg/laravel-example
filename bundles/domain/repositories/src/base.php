<?php

namespace Repository;

use Str;

abstract class Base
{
	public function add_tag_constraints($q, $tags)
	{
		if( ! $tags )
			return $q;

		if(! $slug = $q->model->tagable_slug )
			return $q;

		$singular = Str::singular($slug);

		$junction = 'core_tag_'.$singular;

		$q = $q->join($junction, $junction.".{$singular}_id", '=', $q->model->table().'.id')
			   ->join('core_tags', $junction.'.tag_id', '=', 'core_tags.id');

		if($tags)
		{
			$q = $q->where_in('core_tags.slug', $tags);
		}

		return $q;
	}
}