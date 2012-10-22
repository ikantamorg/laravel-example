<?php

namespace Core\Event;

use Core\Abstracts;
use DateTime;
use Core\Artist\Model as Artist;

class Model extends Abstracts\ContactableModel
{
	public static $table = 'core_events';

	protected $_active_artists = [];
	protected $_performing_artists = [];

	const DB_DATE_FORMAT = 'Y-m-d';
	const DB_TIME_FORMAT = 'H:i:s';
	const DB_DATETIME_FORMAT = 'Y-m-d H:i:s';
	const INPUT_DATE_FORMAT = 'd-m-Y';
	const INPUT_TIME_FORMAT = 'g:i A';
	const INPUT_DATETIME_FORMAT = 'd-m-Y g:i A';

	protected $_date_parts = [];

	protected $_start_datetime = null;
	protected $_end_datetime = null;

	public function before_delete()
	{
		parent::before_delete();
		foreach(['artists', 'songs', 'videos', 'venues', 'photos'] as $r)
			$this->$r()->sync([]);
	}

	protected function compare_times($t1, $t2)
	{
		$dt1 = DateTime::createFromFormat(static::INPUT_TIME_FORMAT, $t1);
		$dt2 = DateTime::createFromFormat(static::INPUT_TIME_FORMAT, $t2);

		return $dt1 < $dt2 ? -1 : 1;
	}

	public function before_save()
	{
		$this->slugify();

		foreach(['start_date', 'end_date', 'start_time', 'end_time'] as $p) {
			if( ! isset($this->_date_parts[$p]) )
				return;
		}

		extract($this->_date_parts);

		$start_dt = DateTime::createFromFormat(static::INPUT_DATETIME_FORMAT, $start_date.' '.$start_time);
		$end_dt = DateTime::createFromFormat(static::INPUT_DATETIME_FORMAT, $end_date.' '.$end_time);

		$this->set_attribute(
			'start_time', $start_dt->format(static::DB_DATETIME_FORMAT)
		);

		$this->set_attribute(
			'end_time', $end_dt->format(static::DB_DATETIME_FORMAT)
		);
	}

	public function after_save()
	{
		$this->_start_datetime = null;
		$this->_end_datetime = null;
		$this->_date_parts = [];
	}

	/**Relations and Setters/Getters**/

	public function get_start_date($format = null)
	{
		$format = $format ? : static::INPUT_DATE_FORMAT;
		return $this->get_start_datetime()->format($format);
	}

	public function get_start_time($format = null)
	{
		$format = $format ? : static::INPUT_TIME_FORMAT;
		return $this->get_start_datetime()->format($format);
	}

	public function get_end_date($format = null)
	{
		$format = $format ? : static::INPUT_DATE_FORMAT;
		return $this->get_end_datetime()->format($format);
	}

	public function get_end_time($format = null)
	{
		$format = $format ? : static::INPUT_TIME_FORMAT;
		return $this->get_end_datetime()->format($format);
	}

	/*storing input dates in our date_parts array for processing before save*/
	public function set_start_date($val)
	{
		$this->_date_parts['start_date'] = $val;
	}

	public function set_start_time($val)
	{
		$this->_date_parts['start_time'] = $val;
	}

	public function set_end_date($val)
	{
		$this->_date_parts['end_date'] = $val;
	}

	public function set_end_time($val)
	{
		$this->_date_parts['end_time'] = $val;
	}
	/********************************************************************/

	protected function round_datetime_to_next_fifth_minute(DateTime $dt)
	{
		$format = 'Y-m-d g:i:s';
		$dt_parts = explode(' ', $dt->format($format));

		$time_parts = explode(':', $dt_parts[1]);
		$minutes = (int) $time_parts[1];
		$minutes = $minutes + 5 - ($minutes%5);
		$minutes = $minutes < 10 ? '0'.$minutes : $minutes;
		$time_parts[1] = $minutes;
		
		$time_parts = implode(':', $time_parts);

		$dt_parts[1] = $time_parts;

		return DateTime::createFromFormat($format, implode(' ', $dt_parts));
	}

	/*********************************************************************/

	public function get_start_datetime()
	{
		if($this->_start_datetime)
			return $this->_start_datetime;

		return $this->_start_datetime = $this->get_attribute('start_time') === null ?
											$this->round_datetime_to_next_fifth_minute(new DateTime)
										:	DateTime::createFromFormat(
												static::DB_DATETIME_FORMAT,
												$this->get_attribute('start_time')
											);
	}

	public function get_end_datetime()
	{
		if($this->_end_datetime)
			return $this->_end_datetime;

		return $this->_end_datetime = $this->get_attribute('end_time') === null ?
											$this->round_datetime_to_next_fifth_minute(new DateTime)
										:	DateTime::createFromFormat(
												static::DB_DATETIME_FORMAT,
												$this->get_attribute('end_time')
											);
	}

	/********/

	public function type()
	{
		return $this->belongs_to('Core\\Event\\Type', 'type_id');
	}

	public function companies()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Company\\Model',
			'core_company_event','event_id', 'company_id'
		);
	}

	public function artists()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Artist\\Model', 
			'core_event_artist', 'event_id', 'artist_id'
		);
	}

	public function songs()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Media\\Song',
			'core_event_song', 'event_id', 'song_id'
		);
	}

	public function videos()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Media\\Video',
			'core_event_video', 'event_id', 'video_id'
		);
	}

	public function venues()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Venue\\Model',
			'core_event_venue', 'event_id', 'venue_id'
		);
	}

	public function photos()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Media\\Photo', 
			'core_event_photo', 'event_id', 'photo_id'
		);
	}
	
	public function photo_albums()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Media\\Photo\\Album',
			'core_event_photo_album','event_id', 'photo_album_id'
		);
	}
	
	public function get_venue()
	{
		return head($this->venues);
	}

	public function profile_photo()
	{
		return $this->belongs_to('Core\\Media\\Photo', 'profile_photo_id');
	}


	public function cover_photo()
	{
		return $this->belongs_to('Core\\Media\\Photo', 'cover_photo_id');
	}

	public function get_profile_photo_url($format = null)
	{
		return $this->profile_photo ? $this->profile_photo->get_url($format) : '';
	}

	public function get_active_artists()
	{
		if($this->_active_artists)
			return $this->_active_artists;

		$q = Artist::join('core_event_artist', 'core_event_artist.artist_id', '=', Artist::$table.'.id')
				   ->join(static::$table, 'core_event_artist.event_id', '=', static::$table.'.id')
				   ->select(Artist::$table.'.*')
				   ->distinct()
				   ->where(static::$table.'.id', '=', $this->id)
				   ->where(Artist::$table.'.active', '=', 1);

		return $this->_active_artists = $q->get();
	}
	public function get_performing_artists()
	{
		if($this->_performing_artists)
			return $this->_performing_artists;

		$q = Artist::join('core_event_artist', 'core_event_artist.artist_id', '=', Artist::$table.'.id')
				   ->join(static::$table, 'core_event_artist.event_id', '=', static::$table.'.id')
				   ->select(Artist::$table.'.*')
				   ->distinct()
				   ->where(static::$table.'.id', '=', $this->id)
				   ->where(Artist::$table.'.active', '=', 1);

		return $this->_performing_artists = $q->get();
	}
}