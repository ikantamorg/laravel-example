<?php

namespace Repository;

use Core\Classification\Tag;
use Core\Classification\Tag\Type;
use Core\Tagable\Model as Tagable;

class Tags extends Base
{
	public function find_for_tagable($slug)
	{
		if(! $tagable = Tagable::find_by_slug($slug) )
			return [];

		return $tagable->primary_tag_type->tags;
	}

	protected function q()
	{
		return Tag::where(Tag::$table.'.active', '=', 1)->select(Tag::$table.'.*')->distinct();
	}

	protected function filtered_q()
	{
		$params = $this->_filter;

		$q = $this->q();

		if($tagable_slug = @$params['tagable']) {
			$q = $q->join('core_tag_tag_type', 'core_tag_tag_type.tag_id', '=', $q->column('id'))
				   ->join(Type::$table, Type::$table.'.id', '=', 'core_tag_tag_type.tag_type_id')
				   ->join('core_tagable_tag_type', 'core_tagable_tag_type.tag_type_id', '=', Type::$table.'.id')
				   ->join(Tagable::$table, Tagable::$table.'.id', '=', 'core_tagable_tag_type.tagable_id')
				   ->where(Tagable::$table.'.slug', '=', $tagable_slug);
		}

		if($tag_slugs = @$params['tag_slugs']) {
			$q = $q->where_in(Tag::$table.'.slug', $tag_slugs);
		}

		
	}

	public function find_filtered()
	{

	}
}