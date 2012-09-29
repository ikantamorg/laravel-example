<?php

class ComposersLoader
{
	protected static $loaded_bundles = array();

	public static function load(array $args = array())
	{
		if( is_null($composers = array_get($args, 'composers')) or is_null($bundle = array_get($args, 'bundle')) )
		{
			throw new Exception('Invalid call to "ComposersLoader::load" function');
		}

		if( array_get(static::$loaded_bundles, 'bundle') )
		{
			return;
		}

		$path = Bundle::path($bundle);

		foreach($composers as $r)
		{
			require $path . 'composers' . DS . $r . EXT;
		}
	}
}