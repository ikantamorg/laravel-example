<?php

namespace Gatekeeper;
use Config;

class Rules
{
	public static function restricted_paths()
	{
		return Config::get('gatekeeper::restricted-paths');
	}

	public static function redirects()
	{
		return Config::get('gatekeeper::redirects');
	}

	public static function api_paths()
	{
		return Config::get('gatekeeper::api-calls');
	}
}