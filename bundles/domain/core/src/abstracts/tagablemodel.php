<?php

namespace Core\Abstracts;

use Str;
use Core\Tagable\Map;
use Core\Tagable\Model as Tagable;

abstract class TagableModel extends Model
{
	public function get_tagable_slug()
	{
		$slug = Map::class_to_slug(get_called_class());
		return Tagable::where_slug($slug)->first();
	}

	public function before_delete()
	{
		$this->tags()->sync([]);
	}

	public function tags()
	{
		$slug = Map::class_to_slug(get_called_class());

		return $this->has_many_and_belongs_to(
			'Core\\Classification\\Tag',
			'core_tag_'.Str::singular($slug),
			Str::singular($slug) . '_id',
			'tag_id'
		);
	}
}