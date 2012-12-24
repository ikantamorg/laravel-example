<?php

Autoloader::map([
	'Dashboard_Base_Controller' => Bundle::path('dashboard') . 'controllers/base.php'
]);

Autoloader::namespaces([
	'Dashboard' => Bundle::path('dashboard') . 'src'
]);

Autoloader::alias('Dashboard\\Dashboard', 'Dashboard');

View::composer('dashboard::layouts.base', function ($view) {
	IoC::resolve('common-assets');

	Asset::container('dashboard')
			->add('style', 'css/dashboard.css')
			->add('soundmanager', 'js/lib/soundmanager2-nodebug.js')
			->add('soundmanager-init', 'js/scripts/soundmanager.init.js');
	
});

View::share('user', Auth::user());

View::composer('dashboard::common.partials.artist-fav-icon', function ($view) {
	dashboard_fav_icon_class($view, 'artists', $view->artist);
});

View::composer('dashboard::common.partials.event-fav-icon', function ($view) {
	dashboard_fav_icon_class($view, 'events', $view->event);
});

View::composer('dashboard::common.partials.song-fav-icon', function ($view) {
	dashboard_fav_icon_class($view, 'songs', $view->song);
});

View::composer('dashboard::common.partials.video-fav-icon', function ($view) {
	dashboard_fav_icon_class($view, 'videos', $view->video);
});
	

function dashboard_fav_icon_class($view, $resource_type, $resource)
{
	$view->class = isset($view->class) ? ' '.$view->class : '';
	$view->is_favorited = false;
	if($user = Auth::user() and $user->in_favorited($resource_type, $resource)) {
		$view->is_favorited = $user->in_favorited($resource_type, $resource);
		$view->class .= ' added-fav';
	}
}

function dashboard_nav_attr($slug)
{
	if(starts_with(URI::current(), 'dashboard/'.$slug))
		return ' selected';
	else
		return '';
}