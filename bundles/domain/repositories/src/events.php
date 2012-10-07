<?php

namespace Repository;

use Core\Event\Model;
use DateTime;

class Events
{
	protected $_today_datetime = null;

	protected function today_datetime()
	{
		if($this->_today_datetime)
			return $this->_today_datetime;

		$dt = new DateTime;
		return $this->_today_datetime = DateTime::createFromFormat('Y M d', $dt->format('Y M d'));
	}

	protected function q()
	{
		return Model::with([
			'artists',
			'artists.songs',
			'artists.videos',
			'profile_photo',
			'venues',
			'venues.city'
		]);
	}

	public function get_upcoming()
	{
		$q = $this->q()->join('core_event_venue', 'core_event_venue.event_id', '=', 'core_events.id')
					   ->join('core_venues', 'core_venues.id', '=', 'core_event_venue.venue_id')
					   ->where('core_venues.city_id', '=', 1)
					   ->select('core_events.*')
					   ->where('core_events.start_time', '>', $this->today_datetime())->order_by('core_events.start_time');

		return $q->paginate();
	}

	public function get_past()
	{
		$q = $this->q()->where('start_time', '<', $this->today_datetime())->order_by('start_time', 'desc');
	}

	public function get_listing()
	{
		$q = $this->q()->order_by('start_time', 'desc');
		return $q->paginate();
	}

	public function get_upcoming_count()
	{
		return Model::where('start_time', '>', $this->today_datetime())->count();
	}

	public function count()
	{
		return Model::count('id');
	}
}