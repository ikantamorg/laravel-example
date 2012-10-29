<?php

namespace Core\Artist;

use Core\Model\Base;
use Core\Abstracts;
use Core\Event\Model as Event;
use DateTime;
use Core\Media\Video;
use Core\Media\Song;

class Model extends Abstracts\IndustryPlayerModel
{
	public static $table = 'core_artists';

	protected $_closest_relevant_event = null;

	protected $_random_video = null;

	protected $_upcoming_events = [];
	protected $_past_events = [];

	protected $_active_songs = [];
	protected $_active_videos = [];

	public function before_delete()
	{
		parent::before_delete();
		$this->songs()->sync([]);
		$this->videos()->sync([]);
		$this->events()->sync([]);
		$this->genres()->sync([]);
		$this->photos()->sync([]);
	}

	public function before_save()
	{
		$this->slugify();
	}


	/**Relations and Getters/Setters**/

	public function companies()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Company\\Model',
			'core_company_artist',
			'artist_id',
			'company_id'
		);
	}

	public function type()
	{
		return $this->belongs_to('Core\\Artist\\Type', 'type_id');
	}

	public function current_city()
	{
		return $this->belongs_to('Core\\Geo\\City', 'current_city_id');
	}

	public function home_city()
	{
		return $this->belongs_to('Core\\Geo\\City', 'home_city_id');
	}

	public function songs()
	{
		return $this->has_many_and_belongs_to('Core\\Media\\Song', 'core_artist_song', 'artist_id', 'song_id');
	}

	public function featured_songs()
	{
		return $this->has_many_and_belongs_to('Core\\Media\\Song', 'core_artist_featured_songs', 'artist_id', 'song_id');
	}

	public function videos()
	{
		return $this->has_many_and_belongs_to('Core\\Media\\Video', 'core_artist_video', 'artist_id', 'video_id');
	}

	public function featured_videos()
	{
		return $this->has_many_and_belongs_to('Core\\Media\\Video', 'core_artist_featured_videos', 'artist_id', 'video_id');
	}

	public function events()
	{
		return $this->has_many_and_belongs_to('Core\\Event\\Model','core_event_artist','artist_id','event_id');
	}

	public function genres()
	{
		return $this->has_many_and_belongs_to('Core\\Classification\\Genre','core_artist_genre','artist_id','genre_id');
	}

	public function photos()
	{
		return $this->has_many_and_belongs_to('Core\\Media\\Photo', 'core_artist_photo', 'artist_id', 'photo_id');
	}

	public function profile_photo()
	{
		return $this->belongs_to('Core\\Media\\Photo', 'profile_photo_id');
	}

	public function cover_photo()
	{
		return $this->belongs_to('Core\\Media\\Photo', 'cover_photo_id');
	}

	public function photo_albums()
	{
		return $this->has_many_and_belongs_to('Core\\Media\\Photo\\Album', 'core_artist_photo_album', 'artist_id', 'photo_album_id');
	}

	public function get_owned_photos()
	{
		return $this->register_entry->photos;
	}

	public function get_closest_relevant_event()
	{
		if($this->_closest_relevant_event)
			return $this->_closest_relevant_event;

		if($event = $this->find_closest_relevant_event('upcoming'))
			return $this->_closest_relevant_event = $event;
		elseif($event = $this->find_closest_relevant_event('past'))
			return $this->_closest_relevant_event = $event;

		return null;
	}

	protected function today_datetime()
	{
		$dt = new DateTime;
		return DateTime::createFromFormat('Y M d H:i', $dt->format('Y M d') . ' 00:00');
	}

	protected function find_closest_relevant_event($flag = 'upcoming')
	{
		$q = Event::with(['profile_photo', 'venues', 'venues.city'])
				  ->join('core_event_artist', 'core_event_artist.event_id', '=', Event::$table.'.id')
				  ->join('core_artists', 'core_event_artist.artist_id', '=', static::$table.'.id')
				  ->where(static::$table.'.id', '=', $this->id)
				  ->where(Event::$table.'.active', '=', 1)
				  ->select(Event::$table.'.*');

		if($flag === 'past') {
			return $q->where(Event::$table.'.start_time', '<', $this->today_datetime())
					 ->order_by(Event::$table.'.start_time', 'desc')->take(1)->first();
		} else {
			return $q->where(Event::$table.'.start_time', '>', $this->today_datetime())
				   	 ->order_by(Event::$table.'.start_time')->take(1)->first();
		}
	}

	public function get_upcoming_events()
	{
		if($this->_upcoming_events)
			return $this->_upcoming_events;

		return $this->_upcoming_events = $this->find_events_by_timespan('upcoming');
	}

	public function get_past_events()
	{
		if($this->_past_events)
			return $this->_past_events;

		return $this->_past_events = $this->find_events_by_timespan('past');
	}

	protected function find_events_by_timespan($flag)
	{
		$q = Event::with(['venues', 'venues.city'])
					->join('core_event_artist', 'core_event_artist.event_id', '=', Event::$table.'.id')
					->join(static::$table, static::$table.'.id', '=', 'core_event_artist.artist_id')
					->where(static::$table.'.id', '=' , $this->id)
					->where(Event::$table.'.active', '=', 1)
					->select(Event::$table.'.*')
					->distinct();

		if($flag === 'upcoming')
			return $q->where(Event::$table.'.start_time', '>', $this->today_datetime())->get();
		elseif($flag === 'past')
			return $q->where(Event::$table.'.start_time', '>', $this->today_datetime())->get();
		else
			return [];
	}

	public function get_profile_photo_url($format = null)
	{
		return $this->profile_photo ? $this->profile_photo->get_url($format) : '';
	}

	public function get_active_songs()
	{
		if($this->_active_songs)
			return $this->_active_songs;

		return $this->_active_songs = Song::with('artists')
										->join('core_artist_song', 'core_artist_song.song_id', '=', Song::$table.'.id')
										->join(static::$table, 'core_artist_song.artist_id', '=', static::$table.'.id')
										->select(Song::$table.'.*')
										->where(Song::$table.'.active', '=', 1)
										->where(static::$table.'.id', '=', $this->id)
										->distinct()
										->get();
	}

	public function get_active_videos()
	{
		if($this->_active_videos)
			return $this->_active_videos;

		return $this->_active_videos = Video::with('artists')
											->join('core_artist_video', 'core_artist_video.video_id', '=', Video::$table.'.id')
											->join(static::$table, 'core_artist_video.artist_id', '=', static::$table.'.id')
											->select(Video::$table.'.*')
											->where(Video::$table.'.active', '=', 1)
											->where(static::$table.'.id', '=', $this->id)
											->distinct()
											->get();
	}
}