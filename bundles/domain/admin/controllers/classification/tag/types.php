<?php

use Core\Classification\Tag\Type;

class Admin_Classification_Tag_Types_Controller extends Crud_Base_Controller
{
	public $fields = ['name'];
	public $view_base = 'admin::classification.tags.types.';
	public $base_uri = 'admin/classification/tag/types/';

	public function resource($id = null)
	{
		if($this->_resource !== null)
			return $this->_resource;

		return $this->_resource = $id === null ? new Type : Type::find($id);
	}

	public function form()
	{
		$type = $this->resource();

		$form = Hybrid\Form::make(function ($f) use($type) {
			$f->fieldset('Tag Type', function ($fs) use($type) {
				$fs->control('text', 'Name', function ($c) use($type) {
					$c->name = 'name';
					$c->value = @$type->name;
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