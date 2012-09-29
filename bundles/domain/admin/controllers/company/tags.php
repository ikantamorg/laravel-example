<?php

use Core\Company\Tag;

class Admin_Company_Tags_Controller extends Crud_Base_Controller
{
	public $fields = ['name'];

	public $view_base = 'admin::companies.tags.';
	public $base_uri = 'admin/company/tags/';

	public function resource($id = null)
	{
		if($this->_resource)
			return $this->_resource;

		return $this->_resource = $id === null ? new Tag : Tag::find($id);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		return $this->_listing = Tag::all();
	}

	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->fieldset('Tag', function ($fs) {
				$fs->control('text', 'Name', function ($c) {
					$c->name = 'name';
					$c->value = Input::old('name', @$this->resource()->name);
				});
			});
		});

		return $form;
	}

	public function listing_table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->column('id');
			$t->column('name');

			$t->rows($this->listing());
		});

		return $table;
	}
}