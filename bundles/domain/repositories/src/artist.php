<?php

namespace Repository;

use Core\Artist\Model;

class Artist
{
	public static function get_listing($params = [])
	{
		$q = Model::with([
			'featured_songs' => ['aggregate' => function ($q) { $q->take(2); }],
			'profile_photo'
		]);

		return $q->paginate();
	}

	public static function get_artists_count($params = [])
	{
		return Model::count();
	}
}