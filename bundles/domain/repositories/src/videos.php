<?php

namespace Repository;

use Core\Media\Video as Model;

class Videos extends Base
{
	public function get_listing()
	{
		$q = Model::with([
				'artists',
				'artists.videos',
				'artists.songs'
			]);

		return $q->paginate();
	}

	public function get_count()
	{
		return Model::count('id');
	}
}