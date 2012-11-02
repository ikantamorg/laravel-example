<?php

namespace Repository;

use Core\Media\Song as Model;

class Songs extends Base
{
	protected function includes()
	{
		return [
			'artists',
			'artists.profile_photo',
			'artists.videos',
			'artists.songs'
		];
	}
	
	protected function q()
	{
		return Model::where(Model::$table.'.active', '=', 1)->select(Model::$table.'.*')->distinct();
	}

	protected function filtered_q()
	{
		$params = $this->_filter;
		if(array_key_exists('tags', $params))
			return $this->add_tag_constraints($this->q(), (array) $params['tags']);
		else
			return $this->q();
	}

	public function find_by_id($id)
	{
		return Model::where_active(1)->where_id($id)->first();
	}

	public function count()
	{
		$q = $this->filtered_q();
		$q = $q->select($q->model->table().'.id');
		return $q->count('id');
	}

	public function paginate($per_page = 20)
	{
		return $this->eager_load($this->filtered_q())->paginate($per_page);
	}
}