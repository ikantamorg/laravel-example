<?php

namespace Repository;

use Core\Artist\Model;

class Artists
{
	public function get_listing($params = [])
	{
		$q = Model::with([
			'songs' => ['aggregate' => function ($q) { $q->take(2); }],
			'profile_photo'
		]);

		return $q->paginate();
	}

	public function get_count($params = [])
	{
		return Model::count('id');
	}
}