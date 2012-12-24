<?php

namespace Dashboard\Widget;

class FavoritesMenu extends Base
{
	protected $data = [
		'num_fav_artists' => 0,
		'num_fav_events'  => 0,
		'num_fav_songs'   => 0,
		'num_fav_videos'  => 0,

		'selected' => null,
		'role' => null
	];

	protected $view = 'dashboard::common.favorites-menu';

	protected function setup()
	{
		$this->setup_role();
		$this->setup_counts();
		$this->setup_selected();
	}

	protected function setup_role()
	{
		$this->role = 'fan';
	}

	protected function setup_counts()
	{
		foreach(['artists', 'events', 'songs', 'videos'] as $r)
			$this->{'num_fav_'.$r} = $this->repo('user')->count_fav($r);
	}

	protected function setup_selected()
	{

	}
}