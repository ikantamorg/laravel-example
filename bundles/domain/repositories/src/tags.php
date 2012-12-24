<?php

namespace Repository;

use Core\Classification\Tag;
use Core\Classification\Tag\Type;
use Core\Tagable\Model as Tagable;
use DB;

class Tags extends Base
{
	protected function q()
	{
		return Tag::select(Tag::$table.'.*')->where(Tag::$table.'.active', '=', 1)->distinct();
	}

	protected function filtered_q()
	{
		$params = $this->_filter;
		$q = $this->q();

		if($tagable = @$params['tagable'])
			$q = $this->add_tagable_constraint($q);

		if($selected_tags = @$params['selected_tags'])
			$q = $this->add_tag_maps_constraint($q, $selected_tags);
	}

	protected function add_tag_map_constraint($q, $selected_tags, $tagable)
	{
		if(! $tagable instanceof Tagable and ! $tagable = Tagable::find_by_slug($tagable))
			return $q;

		if(! $tag_ids = array_map(function ($t) { return $t->id; }, $selected_tags)) {
			$q = $q->join('core_tag_tag_type', 'core_tag_tag_type.tag_id', '=', Tag::$table.'.id')
				   ->join(Type::$table, Type::$table.'.id', '=', 'core_tag_tag_type.tag_type_id')
				   ->where(Type::$table.'.id', '=', $tagable->primary_tag_type_id);
			
			return $q;
		}

		return $q->join('core_tag_map', 'core_tag_map.tag_b_id', '=', Tag::$table.'.id')
				 ->where('core_tag_map.tagable_id', '=', $tagable->id)
				 ->where_in('core_tag_map.tag_a_id', $tag_ids)
				 ->group_by('core_tag_map.tag_b_id')
				 ->having(DB::raw('count(core_tag_map.tag_b_id)'), '>=', count($tag_ids));
	}

	protected function add_tagable_constraint($q, $tagable)
	{
		if($tagable)
			return $q;

		$q = $q->join('core_tag_tag_type', 'core_tag_tag_type.tag_id', Tag::$table.'.id')
			   ->join(Type::$table, Type::$table.'.id', '=', 'core_tag_tag_type.tag_type_id')
			   ->join('core_tagable_tag_type', 'core_tagable_tag_type.tag_type_id', '=', Type::$table.'.id')
			   ->where('core_tagable_tag_type.tagable_id', '=', $tagable->id);

		return $q;
	}

	public function find_all()
	{
		$q = $this->add_tag_map_constraint($this->q(), (array) @$this->_filter['selected_tags'], @$this->_filter['tagable']);
		return $q->get();
	}

	public function find_by_slug($slug)
	{
		$q = $this->add_tagable_constraint($this->q(), @$this->_filter['tagable']);
		return $q->where(Tag::$table.'.slug', '=', $slug)->first();
	}
}