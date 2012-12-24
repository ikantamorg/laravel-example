<?php

use Core\Artist\Type as ArtistType;

class Admin_Artist_Types_Controller extends Crud_Base_Controller
{
	public $fields = ['name'];
	public $view_base = 'admin::artists.types.';
	public $base_uri = 'admin/artist/types/';

	public function resource($id = null)
	{
		if($this->_resource)
			return $this->_resource;
		return $this->_resource = $id === null ? new ArtistType : ArtistType::find($id);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;
		return $this->_listing = ArtistType::all();
	}

	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->fieldset('Artist Type', function ($fs) {
				$fs->control('text', 'Name', function ($c) {
					$c->name = 'name';
					$c->value = Input::get('name', @$this->resource()->name);
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