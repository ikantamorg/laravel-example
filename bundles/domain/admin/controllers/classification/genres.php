<?php

use Core\Classification\Genre;

class Admin_Classification_Genres_Controller extends Crud_Base_Controller
{
	public $fields = ['name'];
	public $view_base = 'admin::classification.genres.';
	public $base_uri = 'admin/classification/genres/';

	public function resource($id = null)
	{
		if($this->_resource)
			return $this->_resource;

		return $this->_resource = null === $id ? new Genre : Genre::find($id);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		return $this->_listing = Genre::all();
	}

	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->fieldset('Genre', function ($fs) {
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