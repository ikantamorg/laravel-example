<?php

namespace Core\Traits;

use Str;
use Core\Tagable\Map;
use Core\Tagable\Model as Tagable;

trait TagableTrait
{
	protected $_classifiable_tags = [];

	public function get_tagable()
	{
		$slug = Map::class_to_slug(get_called_class());
		return Tagable::where_slug($slug)->first();
	}

	public function before_delete()
	{
		$this->classification_tags()->sync([]);
	}

	public function classification_tags()
	{
		$slug = Map::class_to_slug(get_called_class());

		return $this->has_many_and_belongs_to(
			'Core\\Classification\\Tag',
			'core_tag_'.Str::singular($slug),
			Str::singular($slug) . '_id',
			'tag_id'
		);
	}

	public function classifiable_tags()
	{
		$tags = [];

		foreach($this->tagable->tag_types as $tt)
		{
			foreach($tt->tags as $t)
			{
				$tags[$t->id] = $t;
			}
		}

		return $this->_classifiable_tags = array_values($tags);
	}
}