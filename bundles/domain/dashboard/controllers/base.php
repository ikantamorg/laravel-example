<?php

abstract class Dashboard_Base_Controller extends Rest_Controller
{
	public $per_page = 30;

	protected $_appendage = [];

	public function before()
	{
		if(Auth::user() and Auth::user()->is_admin())
			Config::set('application.profiler', true);
	}

	public function repo($slug)
	{
		return Repository::of($slug);
	}

	protected function appendage()
	{
		if($this->_appendage)
			return $this->_appendage;

		$arr = Input::get();
		unset($arr['page']);
		return $this->_appendage = $arr;
	}
}