<?php

namespace Repository;

use Core\Media\Song as Model;

class Songs extends Base
{
	public function get_listing()
	{
		$q = Model::with(['artists', 'artists.profile_photo', 'artists.videos', 'artists.songs']);

		return $q->paginate();
	}

	public function get_count()
	{
		return Model::count('id');
	}
}