<?php

use Core\User\Model as User;
use Core\User\Role;

class Admin_Acl_Users_Controller extends Crud_Base_Controller
{
	public $fields = ['username', 'email', 'password', 'repeated_password'];
	public $relations = ['roles'];
	public $view_base = 'admin::acl.users.';
	public $base_uri = 'admin/acl/users/';

	/***Flags***/
	
	/***********/

	public function resource($id = null)
	{
		if($this->_resource !== null)
			return $this->_resource;

		return $this->_resource = null === $id ? new User : User::find($id);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		return $this->_listing = User::all();
	}

	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->fieldset('User', function ($fs) {
				if($this->_action === 'new') {
					$fs->control('text', 'Username', function ($c) {
						$c->name = 'username';
						$c->value = Input::old('username', @$this->resource()->username);
					});

					$fs->control('email', 'Email', function ($c) {
						$c->name = 'email';
						$c->value = Input::old('email', @$this->resource()->email);
					});

					$fs->control('text', 'Password', 'password');
					$fs->control('text', 'Repeat Password', 'repeated_password');
				}

				$fs->control('select', 'Roles', function ($c) {
					$c->name = 'roles[]';
					$c->attr = ['multiple' => 'multiple'];

					$options = [];
					foreach(Role::all() as $r)
						$options[$r->id] = $r->name;
					$c->options = $options;
					$c->value = Input::old('roles', array_map(function ($r){ return $r->id; }, (array) $this->resource()->roles));
				});
			});
		});

		return $form;
	}

	public function listing_table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->column('id');
			$t->column('username');
			$t->column('email');
			
			$t->rows($this->listing());
		});

		return $table;
	}
}