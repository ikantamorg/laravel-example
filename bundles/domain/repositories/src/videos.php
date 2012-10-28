<?php

namespace Repository;

use Core\Media\Video as Model;

class Videos extends Base
{
	protected function includes()
	{
		return [
			'artists',
			'artists.videos',
			'artists.profile_photo',
			'artists.songs',
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