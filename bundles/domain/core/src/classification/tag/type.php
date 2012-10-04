<?php

namespace Core\Classification\Tag;

use DB;
use Core\Abstracts;
use Core\Tagable\Model as Tagable;
use Core\Tagable\Tag;

class Type extends Abstracts\Model
{
	public static $table = 'core_tag_types';
	
	public static $accessible = [];

	public function before_delete()
	{
		$this->tagables()->sync([]);
		$this->tags()->sync([]);
	}

	/**Relations and Setters/Getters**/

	public function tags()
	{
		return $this->has_many_and_belongs_to('Core\\Classification\\Tag', 'core_tag_tag_type', 'tag_type_id', 'tag_id');
	}

	public function tagables()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Tagable\\Model',
			'core_tagable_tag_type', 'tag_type_id', 'tagable_id'
		);
	}
}