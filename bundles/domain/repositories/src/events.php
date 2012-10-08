<?php

namespace Repository;

use Core\Event\Model;
use DateTime;

class Events extends Base
{
	protected $_today_datetime = null;

	protected $_constraints_added = [];

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
			'artists.profile_photo',
			'profile_photo',
			'venues',
			'venues.city'
		]);
	}

	/*******/

	protected function add_city_constraints($q, $slugs)
	{
		$q = $q->join('core_event_venue', 'core_event_venue.event_id', '=', 'core_events.id')
		  	   ->join('core_venues', 'core_venues.id', '=', 'core_event_venue.venue_id')
		  	   ->join('core_cities', 'core_cities.id', '=', 'core_venues.city_id');

		return $q;
	}

	protected function add_upcoming_constraint($q)
	{
		return $q->where('core_events.start_time', '>', $this->today_datetime())->order_by('core_events.start_time', 'asc');
	}

	protected function upcoming_q()
	{
		return $this->add_upcoming_constraint($this->q());
	}

	/*******/
	public function get_upcoming()
	{
		$q = $this->upcoming_q();

		return $q->paginate();
	}

	public function count_upcoming()
	{
		return $this->upcoming_q()->count();
	}
	/*******/

	public function get_listing()
	{
		$q = $this->q()->order_by('start_time', 'desc');
		return $q->paginate();
	}

	public function count()
	{
		return Model::count('id');
	}
}