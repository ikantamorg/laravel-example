<?php

class Dashboard_Me_Favorites_Controller extends Dashboard_Base_Controller
{
	public $layout = 'dashboard::layouts.page.narrow';

	public function get_songs()
	{
		$filter = ['favorited_by_user' => Auth::user()] + Input::get();

		$listing = $this->repo('songs')->filter($filter)->paginate($this->per_page);
		$count = $listing->total;

		if($this->appendage())
			$listing->appends($this->appendage());

		$body = View::make('dashboard::me.favorites.songs', [
					'songs' => $listing->results,
					'num_songs' => $count,
					'prev_link' => $listing->previous(null, true, ['class' => 'pull-left']),
					'next_link' => $listing->next(null, true, ['class' => 'pull-right'])
				]);

		if(Request::ajax())
			return $body;
		else
			$this->layout->body = $body;
	}

	public function get_videos()
	{
		$filter = ['favorited_by_user' => Auth::user()] + Input::get();

		$listing = $this->repo('videos')->filter($filter)->paginate($this->per_page);
		$count = $listing->total;

		if($this->appendage())
			$listing->appends($this->appendage());

		$body = View::make('dashboard::me.favorites.videos', [
					'videos' => $listing->results,
					'num_videos' => $count,
					'prev_link' => $listing->previous(null, true, ['class' => 'pull-left']),
					'next_link' => $listing->next(null, true, ['class' => 'pull-right'])
				]);

		if(Request::ajax())
			return $body;
		else
			$this->layout->body = $body;
	}

	public function get_artists()
	{
		$filter = ['favorited_by_user' => Auth::user()] + Input::get();

		$listing = $this->repo('artists')->filter($filter)->paginate($this->per_page);
		$count = $listing->total;

		if($this->appendage())
			$listing->appends($this->appendage());

		$body = View::make('dashboard::me.favorites.artists', [
					'artists' => $listing->results,
					'num_artists' => $count,
					'prev_link' => $listing->previous(null, true, ['class' => 'pull-left']),
					'next_link' => $listing->next(null, true, ['class' => 'pull-right'])
				]);

		if(Request::ajax())
			return $body;
		else
			$this->layout->body = $body;
	}

	public function get_events()
	{
		$filter = ['favorited_by_user' => Auth::user()] + Input::get();

		$listing = $this->repo('events')->filter($filter)->paginate($this->per_page);
		$count = $listing->total;

		if($this->appendage())
			$listing->appends($this->appendage());

		$body = View::make('dashboard::me.favorites.events', [
					'events' => $listing->results,
					'num_events' => $count,
					'prev_link' => $listing->previous(null, true, ['class' => 'pull-left']),
					'next_link' => $listing->next(null, true, ['class' => 'pull-right'])
				]);

		if(Request::ajax())
			return $body;
		else
			$this->layout->body = $body;
	}

	/***Song actions***/
	public function post_song($id = 0)
	{
		return $this->favorite_resource('songs', $id);
	}

	public function delete_song($id = 0)
	{
		return $this->unfavorite_resource('songs', $id);
	}
	/******************/

	/***Event actions***/
	public function post_event($id = 0)
	{
		return $this->favorite_resource('events', $id);
	}

	public function delete_event($id = 0)
	{
		return $this->unfavorite_resource('events', $id);
	}
	/*******************/

	/***Artist actions***/
	public function post_artist($id = 0)
	{
		return $this->favorite_resource('artists', $id);
	}

	public function delete_artist($id = 0)
	{
		return $this->unfavorite_resource('artists', $id);
	}
	/********************/

	/***Video actions***/
	public function post_video($id = 0)
	{
		return $this->favorite_resource('videos', $id);
	}

	public function delete_video($id = 0)
	{
		return $this->unfavorite_resource('videos', $id);
	}
	/********************/

	/**(un)favoriting methods**/
	protected function favorite_resource($resource_type, $id)
	{
		if(! $resource = $this->repo($resource_type)->find_by_id($id) )
			return Response::error(404);

		$this->repo('user')->add_to_favorites($resource_type, $resource);
		return Redirect::back();
	}

	protected function unfavorite_resource($resource_type, $id)
	{
		if( ! $resource = $this->repo($resource_type)->find_by_id($id) )
			return Response::error(404);

		$this->repo('user')->remove_from_favorites($resource_type, $resource);
		return Redirect::back();
	}
}