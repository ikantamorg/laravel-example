<?php

namespace Core\Artist;

use Core\Model\Base;
use Core\Abstracts;
use Core\Event\Model as Event;
use DateTime;
use Core\Media\Video;

class Model extends Abstracts\IndustryPlayerModel
{
	public static $table = 'core_artists';

	protected $_closest_relevant_event = null;

	protected $_random_video = null;

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
		$q = Event::with(['profile_photo', 'venue', 'venue.city'])
				  ->join('core_event_artist', 'core_event_artist.event_id', '=', Event::$table.'.id')
				  ->join('core_artists', 'core_event_artist.artist_id', '=', static::$table.'.id')
				  ->where(static::$table.'.id', '=', $this->id)->select(Event::$table.'.*');

		if($flag === 'past') {
			return $q->where(Event::$table.'.start_time', '<', $this->today_datetime())
					 ->order_by(Event::$table.'.start_time', 'desc')->take(1)->first();
		} else {
			return $q->where(Event::$table.'.start_time', '>', $this->today_datetime())
				   	 ->order_by(Event::$table.'.start_time')->take(1)->first();
		}
	}
}