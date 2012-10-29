<?php

namespace Repository;

use DB;
use Core\Artist\Model as Artist;
use Core\Event\Model as Event;
use Core\Media\Video;
use Core\Media\Song;

class Featured extends Base 
{
	public function find_all($resource_type)
	{
		if(in_array($resource_type, ['artists', 'events', 'songs', 'videos']))
			return $this->{'featured_'.$resource_type}();

		return [];
	}

	protected function featured_ids($resource_type)
	{
		$rows = DB::table('core_featured')->where_type($resource_type)->select('resource_id')->get();
		return array_map(function ($r) { return $r->resource_id; }, $rows);
	}

	protected function featured_artists()
	{
		return Artist::with('profile_photo')->where_in('id', $this->featured_ids('artists'))->get();
	}

	protected function featured_events()
	{
		return Event::with('profile_photo')->where_in('id', $this->featured_ids('events'))->get();
	}

	protected function featured_videos()
	{
		return Video::where_in('id', $this->featured_ids('videos'))->get();
	}

	protected function featured_songs()
	{
		return Song::with('artists')->where_in('id', $this->featured_ids('songs'))->get();
	}
}