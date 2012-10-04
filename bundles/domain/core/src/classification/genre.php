<?php

namespace Core\Classification;

use Core\Model\Base;
use Core\Abstracts;

class Genre extends Abstracts\TagableModel
{
	public static $table = 'core_genres';

	public static $accessible = [];

	public function before_delete()
	{
		parent::before_delete();
		$this->artists()->sync([]);
		$this->songs()->sync([]);
		$this->videos()->sync([]);
	}

	/**Relations and Setters/Getters**/
	
	public function artists()
	{
		return $this->has_many_and_belongs_to('Core\\Artist\\Model', 'core_artist_genre', 'genre_id', 'artist_id');
	}

	public function songs()
	{
		return $this->has_many_and_belongs_to('Core\\Media\\Song', 'core_song_genre', 'genre_id', 'song_id');
	}

	public function videos()
	{
		return $this->has_many_and_belongs_to('Core\\Media\\Video', 'core_video_genre', 'genre_id', 'video_id');
	}
}