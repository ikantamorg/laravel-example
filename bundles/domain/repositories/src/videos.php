<?php

namespace Repository;

use Core\Media\Video as Model;

class Videos extends Base
{
	protected function q()
	{
		return Model::with([
			'artists',
			'artists.videos',
			'artists.songs',
		])->where(Model::$table.'.active', '=', 1);
	}

	public function filter($params = [])
	{
		if(! $params )
			return $this->q();

		if(array_key_exists('tags', $params))
			return $this->add_tag_constraints($this->q(), (array) $params['tags']);
	}
}