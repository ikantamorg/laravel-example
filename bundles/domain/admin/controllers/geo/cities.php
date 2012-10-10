<?php

use Core\Geo\City, Core\Geo\Country;


class Admin_Geo_Cities_Controller extends Crud_Base_Controller
{
	public $fields = ['name'];
	public $relations = ['country'];
	public $view_base = 'admin::geo.cities.';
	public $base_uri = 'admin/geo/cities/';

	public function resource($id = null)
	{
		if($this->_resource !== null)
			return $this->_resource;

		return $this->_resource = $id === null ? new City : City::with('country')->find($id);
	}

	public function form()
	{
		$city = $this->resource();

		$form = Hybrid\Form::make(function ($f) use ($city) {
			
			$f->fieldset('City', function ($fs) use ($city) {
				$fs->control('text', 'Name', function ($c) use ($city) { 
					$c->name = 'name';
					$c->value = @$city->name;
				});
				
				$fs->control('select', 'Country', function ($c) use ($city) {
					$c->name = 'country';
					$c->value = @$city->country_id;
					$country_options = [];
					foreach(Country::all() as $ctry)
						$country_options[$ctry->id] = $ctry->name;
					$c->options = $country_options;
				});				
			});
		});

		return $form;
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		return $this->_listing = City::with('country')->get();
	}

	public function total_records()
	{
		if($this->_total_records)
			return $this->_total_records;

		return $this->_total_records = City::count();
	}

	public function activated_records()
	{
		if($this->_activated_records)
			return $this->_activated_records;

		return $this->_activated_records = City::where_active(1)->count();
	}

	public function listing_table()
	{
		$listing = $this->listing();
		$table = Hybrid\Table::make(function ($t) use ($listing) {
			$t->column('id');
			$t->column('name');
			$t->column('country', function ($col) {
				$col->value = function ($row) {
					return @$row->country->name;
				};
			});
			$t->empty_message = 'There are no records';
			$t->rows($listing);
		});
		
		return $table;
	}
}