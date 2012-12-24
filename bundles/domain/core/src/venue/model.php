<?php

namespace Core\Venue;

use Core\Abstracts;

class Model extends Abstracts\IndustryPlayerModel
{
	public static $table = 'core_venues';

	public static $accessible = [
		'name',
		'address',
		'about',
		'profile_pic',
		'website',
		'facebook_url',
	];

	public function before_delete()
	{
		parent::before_delete();
		$this->tags()->sync([]);
		$this->events()->sync([]);
		$this->photos()->sync([]);
	}

	public function before_save()
	{
		if($this->city === null)
			return;

		$check = function ($self, $slug) {
			return $self->q()->where_city_id($this->city_id)->where_slug($slug)->first() === null;
		};

		$this->slugify('-', $check);
	}

	/**Relations and Setters/Getters**/

	public function companies()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Company\\Model',
			'core_company_venue',
			'venue_id',
			'company_id'
		);
	}

	public function city()
	{
		return $this->belongs_to('Core\\Geo\\City', 'city_id');
	}

	public function tags()
	{
		return $this->has_many_and_belongs_to('Core\\Venue\\Tag', 'core_venue_venue_tag', 'venue_id', 'venue_tag_id');
	}

	public function events()
	{
		return $this->has_many_and_belongs_to('Core\\Event\\Model', 'core_event_venue', 'venue_id', 'event_id');
	}

	public function photos()
	{
		return $this->has_many_and_belongs_to('Core\\Media\\Photo', 'core_venue_photo', 'venue_id', 'photo_id');
	}

	public function profile_photo()
	{
		return $this->belongs_to('Core\\Media\\Photo', 'profile_photo_id');
	}

	public function get_owned_photos()
	{
		return $this->register_entry->photos;
	}
}