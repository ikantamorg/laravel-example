<?php

class Player_Setup_Controller extends Player_Base_Controller
{
	public function get_templates()
	{
		$data = [
			'bones' => $this->strip_newlines_and_tabs(View::make('player::bones')->render()),
			'song_list_item' => $this->strip_newlines_and_tabs(View::make('player::playlist.song-list-item')->render()),
			'video_list_item' => $this->strip_newlines_and_tabs(View::make('player::playlist.video-list-item')->render())
		];

		return Response::json($data);
	}

	protected function strip_newlines_and_tabs($str)
	{
		return str_replace(["\n", "\t"], '', $str);
	}
}