<?php

use Core\Classification\Tag;
use Core\Tagable\Map, Core\Tagable\Model as Tagable;

class Admin_Classification_Maps_Controller extends App_Controller
{
	public $restful = true;
	public $view_base = 'admin::classification.maps.';
	public $base_uri = 'admin/classification/maps/';

	protected $_resource = null;
	protected $_listing = [];

	public function get_index()
	{
		return View::make($this->view_base.'index')
					->with(['table' => $this->table(), 'base_url' => URL::to($this->base_uri)]);
	}

	public function get_content_maps($id)
	{
		$tag = Tag::find($id);
		$tag->load_content_maps();

		return View::make($this->view_base.'content_maps')
					->with([
						'base_url' => URL::to($this->base_uri),
						'tag' => $tag,
						'content_options' => function ($slug) {
							$class = Map::slug_to_class($slug);
							$options = [];
							foreach($class::all() as $c)
								$options[$c->id] = $c->name;
							return $options;
						},
						'content_value' => function ($contents) {
							return array_map(function ($c) { return $c->id; }, $contents);
						},
						'tagable_name' => function ($slug) {
							return @Tagable::find_by_slug($slug)->name;
						}
					]);
	}

	public function put_content_maps($id)
	{
		$tag = Tag::find($id);
		$tag->set_content_maps(Input::get());

		return Redirect::to(URL::to($this->base_uri))->with('flash.success', 'Content Maps Made Successfuly');
	}

	public function get_tag_maps($id)
	{
		$tag = Tag::find($id);
		$tag->load_tag_maps();
		
		return View::make($this->view_base.'tag_maps')
					->with([
						'base_url' => URL::to($this->base_uri),
						'tag' => $tag,
						'tag_options' => function ($slug) use($tag) {
							$tagable = Tagable::with(['tag_types', 'tag_types.tags'])->where_slug($slug)->first();
							$options = [];
							foreach($tagable->tag_types as $tt) {
								foreach($tt->tags as $t) {
									if($tag->id !== $t->id) {
										if(! isset($options[$tt->name]) )
											$options[$tt->name] = [$t->id => $t->name];
										
										$options[$tt->name] = $options[$tt->name] + [$t->id => $t->name];
									}
								}
							}
						
							return $options;
						},
						'tag_value' => function ($tags) {
							return array_map(function ($t) { return $t->id; }, $tags);
						},
						'tagable_name' => function ($slug) {
							return @Tagable::find_by_slug($slug)->name;
						}
					]);
	}

	public function put_tag_maps($id)
	{
		$tag = Tag::find($id);
		$tag->set_tag_maps(Input::get());

		return Redirect::to(URL::to($this->base_uri))->with('flash.success', 'Tag Maps Made Successfuly');
	}

	/*****data*****/

	protected function resource($id = null)
	{
		if($this->_resource = null)
			return $this->_resource;

		return $this->_resource = Tag::find($id);
	}

	protected function listing()
	{
		if($this->_listing)
			return $this->_listing;

		return $this->_listing = Tag::all();
	}

	/**************/

	/****widgets***/

	protected function table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->column('id');
			$t->column('name');
			$t->column('type', function ($c) {
				$c->value = function ($r) { return implode(', ', array_map(function ($t) { return $t->name; }, (array) @$r->types)); };
			});
			$t->column('', function ($c) {
				$c->value = function ($r) { return HTML::link(URL::to($this->base_uri.'content_maps/'.$r->id), 'Content Maps'); };
			});
			$t->column('', function ($c) {
				$c->value = function ($r) { return HTML::link(URL::to($this->base_uri.'tag_maps/'.$r->id), 'Tag Maps'); };
			});

			$t->rows($this->listing());
			$t->attr(['class' => 'table table-striped table-bordered']);
			$t->empty_message = 'There are no records';
		});

		return $table;
	}

	/**************/
}