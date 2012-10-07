<?php

namespace Repository;

use Core\Media\Song as Model;

class Songs
{
	public function get_listing()
	{
		$q = Model::with(['artists', 'artists.videos', 'artists.songs']);

		return $q->paginate();
	}

	public function get_count()
	{
		return Model::count('id');
	}
}