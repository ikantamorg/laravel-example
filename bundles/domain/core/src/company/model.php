<?php

namespace Core\Company;

use Core\Abstracts;

class Model extends Abstracts\IndustryPlayerModel
{
	public static $table ='core_companies';

	public static $accessible = [];

	public function before_delete()
	{
		parent::before_delete();
		$this->artists()->sync([]);
		$this->venues()->sync([]);
		$this->events()->sync([]);
	}

	public function before_save()
	{
		$this->slugify();
	}

	/**Relations and Setters\Getters**/

	public function city()
	{
		return $this->belongs_to('Core\\Geo\\City', 'city_id');
	}

	public function tags()
	{
		return $this->has_many_and_belongs_to('Core\\Company\\Tag', 'core_company_company_tag', 'company_id', 'tag_id');
	}

	public function photos()
	{
		return $this->has_many_and_belongs_to('Core\\Media\\Photo', 'core_company_photo', 'company_id', 'photo_id');
	}

	public function profile_photo()
	{
		return $this->belongs_to('Core\\Media\\Photo', 'profile_photo_id');
	}

	public function get_owned_photos()
	{
		return $this->register_entry->photos;
	}

	public function artists()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Artist\\Model',
			'core_company_artist',
			'company_id',
			'artist_id'
		);
	}

	public function venues()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Venue\\Model',
			'core_company_venue',
			'company_id',
			'venue_id'
		);
	}

	public function events()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Event\\Model',
			'core_event_organizers',
			'company_id',
			'event_id'
		)->distinct();
	}
}