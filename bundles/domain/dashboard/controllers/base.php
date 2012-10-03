<?php

abstract class Dashboard_Base_Controller extends Rest_Controller
{
	public $layout = 'dashboard::base';
	
	public function before()
	{
		Config::set('application.profiler', false);
	}
}