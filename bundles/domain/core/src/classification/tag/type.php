<?php

namespace Core\Classification\Tag;

use DB;
use Core\Abstracts;

class Type extends Abstracts\Model
{
	public static $table = 'core_tag_types';
	
	public static $accessible = [];

	public function before_delete()
	{
		$this->tagables()->sync([]);
		DB::table(Core\Classification\Tag::$table)->where_type_id($this->id)->update(['type_id' => 0]);
	}

	/**Relations and Setters/Getters**/

	public function tags()
	{
		return $this->has_many('Core\\Classification\\Tag', 'type_id');
	}

	public function tagables()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Tagables\\Model',
			'core_tagable_tag_type', 'tag_type_id', 'tagable_id'
		);
	}
}