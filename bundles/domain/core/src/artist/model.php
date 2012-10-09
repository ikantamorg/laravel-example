<?php

namespace Core\Artist;

use Core\Model\Base;
use Core\Abstracts;

class Model extends Abstracts\IndustryPlayerModel
{
	public static $table = 'core_artists';

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

	public function get_owned_photos()
	{
		return $this->register_entry->photos;
	}
}