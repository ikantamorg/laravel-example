<?php

use Core\Venue\Tag as VenueTag;

class Admin_Venue_Tags_Controller extends Crud_Base_Controller
{
	public $fields = ['name'];
	public $view_base = 'admin::venues.tags.';
	public $base_uri = 'admin/venue/tags/';

	public function resource($id = null)
	{
		if($this->_resource)
			return $this->_resource;
		return $this->_resource = $id === null ? new VenueTag : VenueTag::find($id);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;
		return $this->_listing = VenueTag::all();
	}

	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->fieldset('Venue Tag', function ($fs) {
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