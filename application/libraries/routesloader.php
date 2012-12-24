<?php

class RoutesLoader
{
	protected static $loaded_bundles = array();

	public static function load(array $args = array())
	{
		if( is_null($routes = array_get($args, 'routes')) or is_null($bundle = array_get($args, 'bundle')) )
		{
			throw new Exception('Invalid call to "RoutesLoader::load" function');
		}

		if( array_get(static::$loaded_bundles, 'bundle') )
		{
			return;
		}

		$path = Bundle::path($bundle);

		foreach($routes as $r)
		{
			require $path . 'routes' . DS . $r . EXT;
		}
	}
}