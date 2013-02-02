<?php

abstract class Player_Base_Controller extends App_Controller
{
	public $restful = true;

	public function before()
	{
		$this->filter('before', 'ajax');
	}

	public function repo($slug)
	{
		return Repository::of($slug);
	}
}