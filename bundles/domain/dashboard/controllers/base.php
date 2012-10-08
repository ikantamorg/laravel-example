<?php

abstract class Dashboard_Base_Controller extends Rest_Controller
{
	public function before()
	{
		Config::set('application.profiler', true);
	}

	public function repo($slug)
	{
		return Repository::of($slug);
	}
}