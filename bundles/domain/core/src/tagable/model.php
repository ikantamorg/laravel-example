<?php

namespace Core\Tagable;

use Core\Abstracts;
use DB;

class Model extends Abstracts\Model
{
	public static $table = 'core_tagables';

	public function save($force_save = false, $exceptions = false)
	{
		if(! $this->exists )
			throw new Exception('Creating new Tagables this way is forbidden');

		$dirty = $this->get_dirty();

		if(isset($dirty['name']) or isset($dirty['slug']))
			throw new Exception('Modifying "name" or "slug" of a tagable is not allowed');

		return parent::save($force_save, $exceptions);
	}

	public static $accessible = [];

	public function after_update()
	{
		$connected_tag_type_ids = array_map(function ($el) { return $el->id; }, $this->tag_types);

		if( ! in_array($this->primary_tag_type_id, $connected_tag_type_ids) )
			DB::table(static::$table)->where_id($this->id)
									 ->update(['primary_tag_type_id' => 0]);
	}

	
	/**Relations and Setters/Getters**/

	public function tag_types()
	{
		return $this->has_many_and_belongs_to(
			'\\Core\\Classification\\Tag\\Type',
			'core_tagable_tag_type', 'tagable_id', 'tag_type_id'
		);
	}

	public function primary_tag_type()
	{
		return $this->belongs_to('\\Core\\Classification\\Tag\\Type', 'primary_tag_type_id');
	}

	public function delete()
	{
		throw new Exception('Deleting a Tagable this way is not allowed');
	}

	public function get_associated_class()
	{
		return Map::slug_to_class($this->slug);
	}

	protected static $_tagables = [];

	public static function find_by_slug($slug)
	{
		if(! static::$_tagables )
		{
			foreach(static::all() as $tagable)
				static::$_tagables[$tagable->slug] = $tagable;
		}

		return $slug ? array_get(static::$_tagables, $slug) : null;
	}
}