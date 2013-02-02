<?php

use Core\User\Role as Role;

class Admin_Acl_Roles_Controller extends Crud_Base_Controller
{
	public $fields = ['name'];
	public $view_base = 'admin::acl.roles.';
	public $base_uri = 'admin/acl/roles/';

	public function resource($id = null)
	{
		if($this->_resource)
			return $this->_resource;

		return $this->_resource = null === $id ? new Role : Role::find($id);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		return $this->_listing = Role::all();
	}

	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->fieldset('Role', function ($fs) {
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