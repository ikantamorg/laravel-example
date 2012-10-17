<?php

class Dashboard_Artists_Profile_Controller extends Dashboard_Base_Controller
{
	public $layout = 'dashboard::layouts.page.wideview';

	public function get_index($slug = null)
	{
		if(! $artist = $this->repo('artists')->find_by_slug($slug) )
			return Response::error(404);

		return $this->layout->nest('body', 'dashboard::profiles.artist.index', [
					'artist' => $artist
				]);
	}

	public function get_info($slug = null)
	{
		if(! $artist = $this->repo('artists')->find_by_slug($slug) )
			return Response::error(404);

		return $this->layout->nest('body', 'dashboard::profiles.artist.info', [
					'artist' => $artist
				]);
	}

	public function get_songs($slug = null)
	{
		if(! $artist = $this->repo('artists')->find_by_slug($slug) )
			return Response::error(404);

		return $this->layout->nest('body', 'dashboard::profiles.artist.songs', [
					'artist' => $artist
				]);
	}

	public function get_events($slug = null)
	{
		if(! $artist = $this->repo('artists')->find_by_slug($slug) )
			return Response::error(404);

		return $this->layout->nest('body', 'dashboard::profiles.artist.events', [
					'artist' => $artist
				]);
	}

	public function get_videos($slug = null)
	{
		if(! $artist = $this->repo('artists')->find_by_slug($slug) )
			return Repsonse::error(404);

		return $this->layout->nest('body', 'dashboard::profiles.aritst.videos', [
					'artist' => $artist
				]);
	}

	public function get_albums($slug = null)
	{
		if(! $artist = $this->repo('artists')->find_by_slug($slug) )
			return Response::error(404);

		return $this->layout->nest('body', 'dashboard::profiles.artist.albums', [
					'artist' => $artist
				]);
	}
}