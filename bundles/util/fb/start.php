<?php

require_once 'src/facebook.php';

IoC::singleton('fb', function()
{
	$active_app = Config::get('fb::active.app');
	return new Facebook(Config::get("fb::apps.{$active_app}"));
});

foreach(Config::get('fb::apps') as $app => $keys)
{
	IoC::singleton("fb.{$app}", function() use($keys)
	{
		return new Facebook($keys);
	});
}
