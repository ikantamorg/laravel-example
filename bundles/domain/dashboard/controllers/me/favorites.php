<?php

class Dashboard_Me_Favorites_Controller extends Dashboard_Base_Controller
{
	public $layout = 'dashboard::layouts.page.narrow';

	public function get_songs()
	{

	}

	public function get_videos()
	{

	}

	public function get_artists()
	{

	}

	public function get_events()
	{

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