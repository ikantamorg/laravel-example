<?php

namespace Core\Media\Song;

use Core\Abstracts;
use Core\Media;
use DB;

class Type extends Abstracts\Model
{
	public static $table = 'core_song_types';

	public static $accessible = [];

	public function before_delete()
	{
		DB::table(Media\Song::$table)->where_type_id($this->id)->update(['type_id' => 0]);
	}

	/***Relations and Getters/Setters***/

	public function songs()
	{
		return $this->has_many('Core\\Media\\Song', 'type_id');
	}
}