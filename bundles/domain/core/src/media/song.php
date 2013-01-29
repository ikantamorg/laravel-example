<?php

namespace Core\Media;

use Core\Abstracts;
use DB;
use Locator;

class Song extends Abstracts\MediaModel
{
	public static $table = 'core_songs';

	public static $accessible = [];

	public function before_delete()
	{
		parent::before_delete();
		$this->artists()->sync([]);
		$this->genres()->sync([]);
		DB::table('core_artist_featured_songs')
		  ->where('song_id', '=', $this->id)->delete();
	}

	public function before_save()
	{
		$this->slugify();
	}

	/**Relations and Setters/Getters**/

	public function get_stream_url()
	{
		if($this->get_attribute('provider') === 'soundcloud')
			return $this->get_attribute('stream_url');
		else
			return Locator::aws()->locate($this->get_attribute('stream_url'))->url();
	}

	public function type()
	{
		return $this->belongs_to('Core\\Media\\Song\\Type', 'type_id');
	}

	public function artists()
	{
		return $this->has_many_and_belongs_to('Core\\Artist\\Model', 'core_artist_song', 'song_id', 'artist_id');
	}

	public function genres()
	{
		return $this->has_many_and_belongs_to('Core\\Classification\\Genre', 'core_song_genre', 'song_id', 'genre_id');
	}

	public function events()
	{
		return $this->has_many_and_belongs_to('Core\\Event\\Model', 'core_event_song', 'song_id', 'event_id');
	}

	public function industry_register_entry()
	{
		return $this->belongs_to('IndustryPlayer\\RegisterEntry', 'owner_id');
	}	
}