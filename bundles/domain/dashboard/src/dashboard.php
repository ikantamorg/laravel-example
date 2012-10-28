<?php

namespace Dashboard;

class Dashboard
{
	protected static $_widgets = [];

	public static function widget($slug)
	{
		if(array_key_exists($slug, static::$_widgets))
			return static::$_widgets[$slug];

		$class = static::map_slug_to_class($slug);

		return static::$_widgets[$slug] = new $class;
	}

	protected static function map_slug_to_class($slug)
	{
		$parts = explode('.', $slug);

		$class = 'Dashboard\\Widget\\';

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