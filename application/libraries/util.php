<?php

class Util
{
	public static function js_loader($container)
	{
		return new Util\AssetLoader('js', $container);
	}

	public static function css_loader($container)
	{
		return new Util\AssetLoader('css', $container);
	}
}