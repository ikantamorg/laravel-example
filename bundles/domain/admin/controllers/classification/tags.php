<?php

use Core\Classification\Tag;

class Admin_Classification_Tags_Controller extends Crud_Base_Controller
{
	public $fields = ['name', 'active'];
	public $view_base = 'admin::classification.tags.';
	public $base_uri = 'admin/classification/tags/';

	public function resource($id = null)
	{
		if($this->_resource !== null)
			return $this->_resource;

		return $this->_resource = $id === null ? new Tag : Tag::find($id);
	}

	public function form()
	{
		$tag = $this->resource();

		$form = Hybrid\Form::make(function ($f) use($tag) {
			$f->fieldset('Tag', function ($fs) use($tag) {
				$fs->control('text', 'Name', function ($c) use($tag) {
					$c->name = 'name';
					$c->value = Input::old('name', @$tag->name);
				});

				$fs->control('input:checkbox', 'Active', function ($c) {
					$c->name = 'active';
					$c->value = 1;
					$c->attr = ['checked' => Input::old('active', @$this->resource()->active)];
				});
			});
		});

		return $form;
	}

	public function listing()
	{
		return Tag::all();
	}

	public function total_records()
	{
		if($this->_total_records)
			return $this->_total_records;

		return $this->_total_records = Tag::count();
	}

	public function activated_records()
	{
		if($this->_activated_records)
			return $this->_activated_records;

		return $this->_activated_records = Tag::where_active(1)->count();
	}

	public function listing_table()
	{
		$listing = $this->listing();

		$table = Hybrid\Table::make(function ($t) use($listing) {
			$t->column('id');
			$t->column('name');
			
			$t->rows($listing);
		});

		return $table;
	}
}