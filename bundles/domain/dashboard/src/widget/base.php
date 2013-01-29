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

	//params is set here as null in order to check whether an empty array has been provided or not

	public function __construct($uri = null, $user = null, $params = null)
	{
		$this->uri = $uri ? : URI::current();
		$this->uri = starts_with($this->uri, '/') ? substr($this->uri, 1) : $this->uri;
		$this->user = $user ? : Auth::user();
		$this->params = $params === null ? Input::get() : $params;

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