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