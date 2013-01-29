<?php

class Dashboard_Events_Profile_Controller extends Dashboard_Base_Controller
{
	public $layout = 'dashboard::layouts.page.wideview';

	public function get_index($slug = null)
	{
		if(! $event = $this->repo('events')->find_by_slug($slug) )
			return Response::error(404);

		$body = View::make('dashboard::profiles.event.home', [
					'event' => $event
				]);

		if(Request::ajax())
			return $body;
		else
			$this->layout->body = $body;
	}

	public function get_info($slug = null)
	{
		if(! $event = $this->repo('events')->find_by_slug($slug) )
			return Response::error(404);

		$body = View::make('dashboard::profiles.event.layout', [
					'event' => $event,
					'page' => 'info'
				]);

		if(Request::ajax())
			return $body;
		else
			$this->layout->body = $body;
	}

	public function get_artists($slug = null)
	{
		if(! $event = $this->repo('events')->find_by_slug($slug) )
			return Response::error(404);

		$body = View::make('dashboard::profiles.event.layout', [
					'event' => $event,
					'page' => 'artists'
				]);

		if(Request::ajax())
			return $body;
		else
			$this->layout->body = $body;
	}

	public function get_videos($slug = null)
	{
		if(! $event = $this->repo('events')->find_by_slug($slug) )
			return Response::error(404);

		$body = View::make('dashboard::profiles.event.layout', [
					'event' => $event,
					'page' => 'videos'
				]);

		if(Request::ajax())
			return $body;
		else
			$this->layout->body = $body;
	}

	public function get_pictures($slug = null)
	{
		if(! $event = $this->repo('events')->find_by_slug($slug) )
			return Response::error(404);

		$body = View::make('dashboard::profiles.event.layout', [
					'event' => $event,
					'page' => 'pictures'
				]);

		if(Request::ajax())
			return $body;
		else
			$this->layout->body = $body;
	}
}