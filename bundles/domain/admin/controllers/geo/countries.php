<?php

use Core\Geo\Country;

class Admin_Geo_Countries_Controller extends Crud_Base_Controller
{
	public $fields = [];
	public $relations = [];
	public $view_base = 'admin::geo.countries.';
	public $base_uri = 'admin/geo/countries/';

	public function resource($id = null)
	{
		if($this->_resource !== null)
			return $this->_resource;

		return $id === null ? new Country : $this->_reosurce = Country::find($id);
	}

	public function form()
	{
		$country = $this->resource();
		$form = Hybrid\Form::make(function ($f) use ($country) {
			$f->fieldset('Country', function ($fs) use ($country) {
				$fs->control('select', 'Name', function ($c) {
					$c->name = 'name';
					$c->value = @$country->name;
				});
			});
		});

		return $form;
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;
		
		return $this->_listing = Country::all();
	}

	public function listing_table()
	{
		$listing = $this->listing();
		$table = Hybrid\Table::make(function ($t) use ($listing) {
			$t->column('id');
			$t->column('name');
			$t->rows($listing);
		});

		return $table;
	}

	public function put_update()
	{
		return Response::error(404);
	}

	public function delete_destroy()
	{
		return Response::error(404);
	}
}