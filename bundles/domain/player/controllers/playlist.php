<?php

use Player\Playlist;

class Player_Playlist_Controller extends Player_Base_Controller
{
	public function get_index()
	{
		return Response::json(Playlist::instance()->to_array());
	}

	public function get_item($index = null)
	{
		$item = Playlist::instance()->get_item_at($index);
		return Response::json($item ? $item->to_array() : []);
	}

	public function delete_item($index = null)
	{
		return Response::json(['success' => Playlist::instance()->remove_item($index)]);
	}

	public function post_item($type, $id)
	{
		if(! $repo = $this->repo_from_type($type) or ! $model = $repo->find_for_player($id))
			return Response::json(['success' => false]);

		if($index = Playlist::instance()->add_item($type, $model);
			return Respose::json(Playlist::instance()->get_item_at($index)->to_array());
		
		return Response::json(['success' => false]);
	}

	protected function repo_from_type($type)
	{
		if($type === 'song' or $type === 'video')
			return $this->repo(Str::plural($type));

		return null;
	}
}