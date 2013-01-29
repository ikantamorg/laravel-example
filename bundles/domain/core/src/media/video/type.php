<?php

namespace Core\Media\Video;

use Core\Abstracts;
use Core\Media;
use DB;

class Type extends Abstracts\Model
{
	public static $table = 'core_video_types';

	public static $accessible = [];

	public function before_delete()
	{
		DB::table(Media\Video::$table)->where_type_id($this->id)->update(['type_id' => 0]);
	}

	/***Relations and Setters/Getters***/

	public function videos()
	{
		return $this->has_many('Core\\Media\\Video', 'type_id');
	}
}