<?php

namespace Core\Media\Photo;

use Core\Abstracts;

class Album extends Abstracts\MediaModel
{
	public static $table = 'core_photo_albums';

	public function before_delete()
	{
		parent::before_delete();
		foreach(['photos', 'artists', 'venues', 'events', 'companies'] as $r)
			$this->$r()->sync([]);
	}

	public function cover_photo()
	{
		return $this->belongs_to('Core\\Media\\Photo', 'cover_photo_id');
	}

	public function photos()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Media\\Photo',
			'core_photo_album_photo',
			'photo_album_id',
			'photo_id'
		);
	}

	public function artists()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Artist\\Model', 'core_artist_photo_album', 'photo_album_id', 'artist_id'
		);
	}

	public function venues()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Venue\\Model', 'core_venue_photo_album', 'photo_album_id', 'venue_id'
		);
	}

	public function events()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Event\\Model', 'core_event_photo_album', 'photo_album_id', 'event_id'
		);
	}

	public function companies()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Company\\Model', 'core_company_photo_album', 'photo_album_id', 'company_id'
		);
	}
}