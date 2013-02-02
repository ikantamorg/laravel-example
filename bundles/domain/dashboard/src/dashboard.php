<?php

namespace Dashboard;

use ReflectionClass;

class Dashboard
{
	protected static $_widgets = [];

	protected static $_base_namespace = 'Dashboard\\Widget';

	public static function widget($slug, $params = [])
	{
		if(array_key_exists($slug, static::$_widgets))
			return static::$_widgets[$slug];

		$class = new ReflectionClass(static::map_slug_to_class($slug));

		return static::$_widgets[$slug] = $class->newInstanceArgs($params);
	}

	protected static function map_slug_to_class($slug)
	{
		$parts = explode('.', $slug);

		$class = static::$_base_namespace . '\\';

		foreach($parts as $i => $p)
		{
			$class .= static::snake_to_camel($p);

			if(@$parts[$i+1])
				$class .= '\\';
		}

		$class = str_replace('.', '\\', $class);

		return $class;
	}

	protected static function snake_to_camel($str)
	{
		$result = '';
		$parts = explode('_', $str);

		foreach($parts as $p)
		{
			$result .= ucfirst($p);
		}

		return $result;
	}
}