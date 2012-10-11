<?php

namespace Repository;

use Core\Media\Song as Model;

class Songs extends Base
{
	protected function q()
	{
		return Model::with([
			'artists',
			'artists.profile_photo',
			'artists.videos',
			'artists.songs'
		])->where(Model::$table.'.active', '=', 1);
	}

	public function filter($params = [])
	{
		if(array_key_exists('tags', $params))
			return $this->add_tag_constraints($this->q(), (array) $params['tags']);
		else
			return $this->q();
	}
}