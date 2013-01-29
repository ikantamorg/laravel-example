<?php

use Core\Event\Type;

class Admin_Event_Types_Controller extends Crud_Base_Controller
{
	public $fields = ['name'];

	public $base_uri = 'admin/event/types/';

	public $view_base = 'admin::events.types.';


	public function resource($id = null)
	{
		if($this->_resource)
			return $this->_resource;

		return $this->_resource = $id === null ? new Type : Type::find($id);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		return $this->_listing = Type::all();
	}

	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->fieldset('Event Type', function ($fs) {
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