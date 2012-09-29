<?php

namespace Gatekeeper;

use Auth, Response, Redirect, Session, UtilTrait, Config;

class Gatekeeper
{
	protected static $_inspected_uri_session_key = 'flash.gatekeeper.inspected-uri';

	public static function inspect($uri)
	{
		static::prepare();
		return new static($uri);	
	}
	
	protected static function prepare()
	{
		if($uri = Session::get(static::$_inspected_uri_session_key))
			Config::set('auth.uri.success', $uri);
	}

	protected $_uri;

	public function is_api_call($uri)
	{
		$parts = explode('/', $uri);

		foreach(Rules::api_paths() as $c) {
			if(in_array($c, $parts))
				return true;
		}

		return false;
	}

	protected function __construct($uri)
	{
		$this->_uri = $uri;
	}

	public function is_restricted()
	{
		foreach(Rules::restricted_paths() as $p)
			if(starts_with($this->_uri, $p))
				return true;
		
		return false;
	}

	public function result()
	{
		if(! $this->is_restricted() )
			return true;

		if(Auth::check())
		{
			Session::forget(static::$_inspected_uri_session_key);
			return true;
		}

		if($this->is_api_call($this->_uri))
		{
			return Response::json(array('error' => 'forbidden'), 403);
		}
		else
		{
			Session::flash(static::$_inspected_uri_session_key, $this->_uri);
			return Redirect::to(array_get(Rules::redirects(), 'login'));
		}
	}
}