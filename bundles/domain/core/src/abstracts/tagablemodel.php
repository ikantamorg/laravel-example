<?php

namespace Core\Abstracts;

use Core\Tagable\Map;
use Core\Tagable\Model as Tagable;

abstract class TagableModel extends Model
{
	public function get_tagable_slug()
	{
		$slug = Map::class_to_slug(get_called_class());
		return Tagable::where_slug($slug)->first();
	}
}