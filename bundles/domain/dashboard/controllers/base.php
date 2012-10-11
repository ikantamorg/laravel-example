<?php

abstract class Dashboard_Base_Controller extends Rest_Controller
{
	public $per_page = 21;

	protected $_appendage = [];

	public function before()
	{
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