<?php

namespace Dashboard\Widget;

use Repository;
use URI, Auth, View, Input;

abstract class Base
{
	protected $data = [];

	protected $view = null;

	protected $uri;
	protected $user;
	protected $params;

	public function __construct($uri = null, $user = null, $params = [])
	{
		$this->uri = $uri ? : URI::current();
		$this->user = $user ? : Auth::user();
		$this->params = $params ? : Input::get();

		$this->setup();
	}

	public function __get($prop)
	{
		return @$this->data[$prop];
	}

	public function __set($prop, $val)
	{
		if(array_key_exists($prop, $this->data))
			$this->data[$prop] = $val;
	}

	protected function repo($slug)
	{
		return Repository::of($slug);
	}

	public function __tostring()
	{
		return $this->render();
	}

	protected function view()
	{
		return View::make($this->view)->with($this->data)->with([
				'user' => $this->user,
				'uri' => $this->uri,
				'params' => $this->params
			]);
	}

	protected function render()
	{
		return $this->view()->render();
	}
}