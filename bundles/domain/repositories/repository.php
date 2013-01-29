<?php

class Repository
{
	protected static $_repos = [];

	public static function of($slug)
	{
		if($repo = @static::$_repos[$slug])
			return $repo;

		$class = static::map_slug_to_class($slug);

		return static::$_repos[$slug] = new $class;
	}

	protected static function map_slug_to_class($slug)
	{
		$parts = explode('.', $slug);

		$class = 'Repository\\';

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