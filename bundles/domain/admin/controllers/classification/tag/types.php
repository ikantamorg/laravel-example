<?php

use Core\Classification\Tag\Type;
use Core\Classification\Tag;

class Admin_Classification_Tag_Types_Controller extends Crud_Base_Controller
{
	public $fields = ['name'];
	public $relations = ['tags'];
	public $view_base = 'admin::classification.tags.types.';
	public $base_uri = 'admin/classification/tag/types/';

	public function resource($id = null)
	{
		if($this->_resource !== null)
			return $this->_resource;

		return $this->_resource = $id === null ? new Type : Type::with('tags')->find($id);
	}

	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->fieldset('Tag Type', function ($fs) {
				$fs->control('text', 'Name', function ($c) {
					$c->name = 'name';
					$c->value = Input::old('name', @$this->resource()->name);
				});

				$fs->control('select', 'Tags', function ($c) {
					$c->name = 'tags[]';
					$options = [];
					foreach(Tag::all() as $t)
						$options[$t->id] = $t->name;
					$c->options = $options;
					$c->value = Input::old('tags', array_map(function ($t) { return $t->id; }, (array) @$this->resource()->tags));
					$c->attr = ['multiple' => 'multiple'];
				});
			});
		});

		return $form;
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		return $this->_listing = Type::all();
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