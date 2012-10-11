<?php

namespace Repository;

use Core\Artist\Model;

class Artists extends Base
{
	public function q()
	{
		return Model::with([
			'featured_songs',
			'profile_photo',
		])->where(Model::$table.'.active', '=', 1)->select(Model::$table.'.*');
	}

	public function filter($params = [])
	{
		if(array_key_exists('tags', $params))
			return $this->add_tag_constraints($this->q(), (array) $params['tags']);
		else
			return $this->q();
	}

	public function count($params = [])
	{
		return Model::where_active(1)->count('id');
	}
}