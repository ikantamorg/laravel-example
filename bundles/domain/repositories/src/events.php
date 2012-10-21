<?php

namespace Repository;

use Core\Event\Model;
use DateTime;

class Events extends Base
{
	protected function includes()
	{
		return [
			'artists',
			'artists.songs',
			'artists.videos',
			'artists.profile_photo',
			'profile_photo',
			'venues',
			'venues.city'
		];
	}
	
	protected $_today_datetime = null;

	protected function today_datetime()
	{
		if($this->_today_datetime)
			return $this->_today_datetime;

		$dt = new DateTime;
		return $this->_today_datetime = DateTime::createFromFormat('Y M d H:i', $dt->format('Y M d') . ' 00:00');
	}

	protected function future_datetime($days_ahead)
	{
		$dt = new DateTime;
		$dt->setTimestamp($this->today_datetime()->getTimestamp + 86400 * (int) $days_ahead);
		return $dt;
	}

	/***************/

	protected function q()
	{
		return Model::where(Model::$table.'.active', '=', 1)->select(Model::$table.'.*');
	}

	protected function filtered_q()
	{
		$params = $this->_filter;

		$q = $this->q();

		if(@$params['city'])
			$q = $this->add_city_constraints($q, @$params['city']);

		if(@$params['tags'])
			$q = $this->add_tag_constraints($q, (array) @$params['tags']);

		if($ts = @$params['timespan'] and $ts === 'past')
		{
			$q = $q->where('start_time', '<', $this->today_datetime())->order_by('start_time', 'desc');
		}
		else
		{
			$q = $q->where('start_time', '>', $this->today_datetime())->order_by('start_time', 'asc');
		}

		return $q;
	}

	/*******/

	protected function add_city_constraints($q, $city)
	{
		$q = $q->join('core_event_venue', 'core_event_venue.event_id', '=', 'core_events.id')
		  	   ->join('core_venues', 'core_venues.id', '=', 'core_event_venue.venue_id')
		  	   ->join('core_cities', 'core_cities.id', '=', 'core_venues.city_id');

		$q = $q->where('core_cities.slug', '=', $city);

		return $q;
	}

	public function find_by_slug($slug)
	{
		return Model::where_slug($slug)->first();
	}
}