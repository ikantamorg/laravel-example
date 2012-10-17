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
		return Model::where(Model::$table.'.active', '=', 1)->select(Model::$table.'.*');
	}

	public function filtered_q()
	{
		$params = $this->_filter;

		if(array_key_exists('tags', $params))
			return $this->add_tag_constraints($this->q(), (array) $params['tags']);
		else
			return $this->q();
	}
}