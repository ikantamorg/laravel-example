<?php

class Dashboard_Events_Profile_Controller extends Dashboard_Base_Controller
{
	public $layout = 'dashboard::layouts.page.wideview';

	public function get_index($slug = null)
	{
		if(! $event = $this->repo('events')->find_by_slug($slug) )
			return Response::error(404);

		return $this->layout->nest('body', 'dashboard::profiles.event.home', [
					'event' => $event
				]);
	}

	public function get_info($slug = null)
	{
		if(! $event = $this->repo('events')->find_by_slug($slug) )
			return Response::error(404);

		return $this->layout->nest('body', 'dashboard::profiles.event.layout', [
					'event' => $event,
					'page' => 'info'
				]);
	}

	public function get_artists($slug = null)
	{
		if(! $event = $this->repo('events')->find_by_slug($slug) )
			return Response::error(404);

		return $this->layout->nest('body', 'dashboard::profiles.event.layout', [
					'event' => $event,
					'page' => 'artists'
				]);
	}

	public function get_videos($slug = null)
	{
		if(! $event = $this->repo('events')->find_by_slug($slug) )
			return Response::error(404);

		return $this->layout->nest('body', 'dashboard::profiles.event.layout', [
					'event' => $event,
					'page' => 'videos'
				]);
	}

	public function get_pictures($slug = null)
	{
		if(! $event = $this->repo('events')->find_by_slug($slug) )
			return Response::error(404);

		return $this->layout->nest('body', 'dashboard::profiles.event.layout', [
					'event' => $event,
					'page' => 'pictures'
				]);
	}
}