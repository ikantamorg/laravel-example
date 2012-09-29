<?php

namespace Core\Tagable;

use Config;

class Map
{
	protected static $_mappings = [];

	public static function mappings()
	{
		if(static::$_mappings)
			return static::$_mappings;

		return static::$_mappings = Config::get('core::tagables');
	}

	public static function list_tagables()
	{
		return array_keys(static::mappings());
	}

	public static function reverse_mappings()
	{
		$mappings = [];
		foreach(static::mappings() as $k=>$v)
		{
			$mappings[$v] = $k;
		}

		return $mappings;
	}

	public static function slug_to_class($slug)
	{
		return array_get(static::mappings(), $slug);
	}

	public static function class_to_slug($class)
	{
		$class = '\\' . ltrim($class, '\\');
		return array_get(static::reverse_mappings(), $class);
	}	
}