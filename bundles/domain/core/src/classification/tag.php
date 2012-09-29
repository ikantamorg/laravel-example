<?php

namespace Core\Classification;

use Core\Abstracts;
use Core\Tagable\Map, Core\Tagable\Model as Tagable;
use Str, DB, DateTime;

class Tag extends Abstracts\Model
{
	public static $table = 'core_tags';

	public static $accessible = [];

	protected $_content_maps = [];
	protected $_tag_maps = [];

	public function before_delete()
	{
		foreach(Map::list_tagables() as $t)
		{
			$this->$t()->sync([]);
		}

		DB::table('core_tag_map')->where_tag_a_id($this->id)->or_where('tag_b_id', '=', $this->id)->delete();
	}

	public function before_save()
	{
		$this->slugify();
	}

	/**Relations and Setters/Getters**/

	public function type()
	{
		return $this->belongs_to('\\Core\\Classification\\Tag\\Type', 'type_id');
	}

	protected function content_map($slug)
	{
		return $this->has_many_and_belongs_to(
			Map::slug_to_class($slug),
			'core_tag_'.Str::singular($slug),
			'tag_id',
			Str::singular($slug).'_id'
		);
	}

	public function artists()
	{
		return $this->content_map(__FUNCTION__);
	}

	public function songs()
	{
		return $this->content_map(__FUNCTION__);
	}

	public function events()
	{
		return $this->content_map(__FUNCTION__);
	}

	public function venues()
	{
		return $this->content_map(__FUNCTION__);
	}

	public function videos()
	{
		return $this->content_map(__FUNCTION__);
	}

	public function genres()
	{
		return $this->content_map(__FUNCTION__);
	}

	public function venue_tags()
	{
		return $this->content_map(__FUNCTION__);
	}

	public function companies()
	{
		return $this->content_map(__FUNCTION__);
	}

	/**Content Maps stuff**/

	public function load_content_maps($content = null)
	{
		foreach(Map::list_tagables() as $tagable)
			$this->_content_maps[$tagable] = $this->$tagable;

		return $this;
	}

	public function get_content_maps()
	{
		return $this->_content_maps;
	}

	protected function get_real_content_ids($slug, $ids)
	{
		if(! $ids )
			return [];

		$class = Map::slug_to_class($slug);
		return array_map(function ($c) { return $c->id; }, $class::where_in('id', $ids)->get());
	}

	public function set_content_maps($data)
	{
		$data = (array) $data;
		foreach(Map::list_tagables() as $tagable)
		{	
			$ids = $this->get_real_content_ids($tagable, (array) @$data[$tagable]);
			$this->$tagable()->sync($ids);
		}

		return $this;
	}

	/***********************/

	/**Tag Maps Stuff**/

	public function load_tag_maps()
	{
		foreach(Tagable::all() as $t)
		{
			$this->_tag_maps[$t->slug] = Tag::with('type')->join('core_tag_map', 'core_tag_map.tag_b_id', '=', 'core_tags.id')
									 ->where('core_tag_map.tagable_id', '=', $t->id)
									 ->where('core_tag_map.tag_a_id', '=', $this->id)
									 ->get('core_tags.*');
		}
		return $this;
	}

	public function get_tag_maps()
	{
		return $this->_tag_maps;
	}

	protected function get_real_tag_ids($tagable, $ids)
	{
		$valid_ids = [];
		foreach($tagable->tag_types as $tt)
			foreach($tt->tags as $t)
				$valid_ids[] = $t->id;

		$valid_ids = array_unique($valid_ids);

		foreach($ids as $i => $id)
			if(! in_array($id, $valid_ids))
				unset($ids[$i]);

		return array_values($ids);
	}

	protected function delete_removed_maps($tagable, $ids)
	{
		if(empty($ids)) {
			if(DB::table('core_tag_map')->where_tagable_id($tagable->id)->count('id') > 0)
				DB::table('core_tag_map')->where_tagable_id($tagable->id)->where_tag_a_id($this->id)
										 ->or_where('tag_b_id', '=', $this->id)->delete();
		} else { 
			foreach($ids as $id) {
				DB::table('core_tag_map')->where_tagable_id($tagable->id)
										 ->where_tag_a_id($this->id)->where_tag_b_id($id)->delete();
				DB::table('core_tag_map')->where_tagable_id($tagable->id)
										 ->where_tag_b_id($this->id)->where_tag_a_id($id)->delete();
			}
		}
	}

	protected function make_mapping($tagable, $a_id, $b_id)
	{
		if( DB::table('core_tag_map')->where_tag_a_id($a_id)->where_tag_b_id($b_id)->where_tagable_id($tagable->id)->first() )
			return false;
		
		DB::table('core_tag_map')->insert([
			'tag_a_id' => $a_id,
			'tag_b_id' => $b_id,
			'tagable_id' => $tagable->id,
			'created_at' => new DateTime,
			'updated_at' => new DateTime
		]);

		return true;
	}

	public function set_tag_maps($data)
	{
		$data = (array) $data;

		foreach(Tagable::with(['tag_types', 'tag_types.tags'])->get() as $t)
		{
			$ids = $this->get_real_tag_ids($t, (array) @$data[$t->slug]);

			$this->delete_removed_maps($t, $ids);

			foreach($ids as $id)
			{
				if((int)$id === (int)$this->id)
					continue;
				
				$a_b_mapping = $this->make_mapping($t, $this->id, $id);
				$b_a_mapping = $this->make_mapping($t, $id, $this->id);

				if($a_b_mapping or $b_a_mapping)
					Tag::find($id)->fill(['updated_at' => new DateTime])->save();
			}
		}

		$this->timestamp();
		$this->save();
	}

	/*******************/

}