<?php

namespace Core\Artist;

use DB;
use Core\Abstracts;

class Type extends Abstracts\Model
{
	public static $accessible = [];
	
	public static $table = 'core_artist_types';

	public function before_delete()
	{
		DB::table(Model::$table)->where_type_id($this->id)->update(['type_id' => 0]);
	}

	/**Relations and Getters/Setters**/
	
	public function artists()
	{
		return $this->has_many('\\Core\\Artist\\Model', 'type_id');
	}
}