<?php

class Admin_Account_Controller extends App_Controller
{
	public $restful = true;

	public $view_base = 'admin::account.';
	public $base_uri = 'admin/account/';

	/***********Actions************/

	public function get_index()
	{
		return View::make($this->view_base.'index')->with(['form' => $this->form()]);
	}

	public function put_update()
	{
		if($errors = $this->validate(Input::get())) {
			Input::flash();
			return Redirect::to($this->base_uri)->with_errors($errors);
		} else {
			$updated_fields = $this->update_user(Input::get());
			Session::flash('flash.success', implode(', ', $updated_fields).' Updated successfully');
			
			return Redirect::to($this->base_uri);
		}				
	}

	/*******************************/

	protected function update_user($data) {
		Auth::user()->username = @$data['username'];
		Auth::user()->email = @$data['email'];
		if(@$data['new_password'])
			Auth::user()->password = @$data['new_password'];

		$updated_fields = array_keys(Auth::user()->get_dirty());
		Auth::user()->save();

		return $updated_fields;
	}

	protected function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->attr(['method' => 'PUT', 'action' => URL::to($this->base_uri.'update')]);

			$f->fieldset('Display Name', function ($fs) {
				$fs->control('text', 'Username', function ($c) {
					$c->name = 'username';
					$c->value = Input::old('username', Auth::user()->username);
				});
			});

			$f->fieldset('Email', function ($fs) {
				$fs->control('text', 'Email', function ($c) {
					$c->name = 'email';
					$c->value = Input::old('email', Auth::user()->email);
				});
			});

			$f->fieldset('Password Stuff', function ($fs) {
				$fs->control('input:password', 'Old Password', function ($c) {
					$c->name = 'old_password';
				});
				$fs->control('input:password', 'New Password', function ($c) {
					$c->name = 'new_password';
				});
				$fs->control('input:password', 'New Password-Again', function ($c) {
					$c->name = 'new_password_again';
				});
			});
		});

		return $form;
	}

	protected function validate($data)
	{
		$errors = [];

		$rules = [
			'username' => 'required|max:200',
			'email'    => 'required|email|unique:'.Auth::user()->table().',email,'.Auth::user()->id,
		];

		if(@$data['new_password']) {
			$rules += [
				'new_password'       => 'required',
				'new_password_again' => 'same:new_password'
			];
		}

		$val = Validator::make($data, $rules);

		if($val->fails()) {
			$errors = $val->errors->messages;
		}

		if(@$data['new_password'] and ! Hash::check(@$data['old_password'], Auth::user()->password)) {
			$errors['old_password'] = 'Old password entered is incorrect';
		}

		return $errors ? new Messages($errors) : $errors;
	}
}