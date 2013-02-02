<?php

class Auth_Controller extends App_Controller
{
	public $restful = true;

	public function get_login()
	{
		if(Auth::user())
			return Redirect::to($this->next_uri());

		return View::make('auth.login')->with('form', $this->form());
	}

	public function post_login()
	{
		$credentials = ['username' => Input::get('email'), 'password' => Input::get('password')];

		if(Auth::attempt($credentials))
		{
			Auth::user()->last_login = new DateTime;
			Auth::user()->save();
			return Redirect::to($this->next_uri());
		}
		else
		{
			Input::flash();
			Session::flash('flash._next_uri', Input::get('_next_uri'));
			return Redirect::to_action('auth@login')->with('flash.error', 'Invalid Username/Pasword');
		}
	}

	public function get_logout()
	{
		if(Auth::user()) {
			Auth::user()->last_logout = new DateTime;
			Auth::user()->save();
			Auth::logout();
		}
		return Redirect::to_action('auth@login')->with('flash.message', 'Successfuly logged out');
	}

	protected function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->attr(['method' => 'POST', 'action' => URL::to_action('auth@login')]);
			$f->fieldset('Login', function ($fs) {
				$fs->control('email', 'Email', function ($c) {
					$c->name = 'email';
					$c->value = Input::old('email');
				});
				$fs->control('password', 'Password', function ($c) {
					$c->name = 'password';
				});
				$fs->control('input:hidden', '', function ($c) {
					$c->value = $this->next_uri();
					$c->name = '_next_uri';
				});
			});
		});

		return $form;
	}

	protected function next_uri()
	{
		return Input::get('_next_uri', Session::get('flash._next_uri', Config::get('auth.uri.success')));
	}
}