<?php

Route::get('/', function()
{
	return View::make('home.index');
});

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

Route::controller(Controller::detect());

View::composer('layouts.app', function ($view) {
	Asset::container('common')
			->add('bs-css', 'css/bootstrap.min.css')
			->add('fonts', 'css/fonts.css', 'bs-css')
			->add('jquery', 'js/jquery-1.7.2.min.js', 'fonts')
			->add('bs-js', 'js/bootstrap.min.js', 'jquery')
			->add('json2', 'js/json2.js', 'bs-js')
			->add('us', 'js/underscore.js', 'json2')
			->add('bb', 'js/backbone.js', 'us');
});

Route::filter('before', function()
{
	$result = Gatekeeper::inspect(URI::current())->result();
	if($result !== true) return $result;

	if($user = Auth::user())
	{
		$result = Bouncer::investigate($user)->allow_or_block_on(URI::current());
		if($result !== true) return $result;
	}
});


Route::get('important-artists', function () {
	
	$rows = DB::table('core_event_artist')->select(['artist_id', DB::raw('count(artist_id) as f')])->group_by('artist_id')->order_by(DB::raw('count(artist_id)'), 'desc')->get();
	
	$artists = array_map(function ($r) { 
		if($a = Core\Artist\Model::find($r->artist_id))
			$a->num_ev = $r->f;
		return $a;
	}, $rows);

	foreach($artists as $i=>$a) {
		if(! $a ) continue;
		echo $i . '. ' . $a->name . '  '. HTML::link($a->facebook_url, 'fb') .', '.HTML::link($a->website_url, 'web') .  ' --- ' . $a->num_ev;
		echo '<br><hr><br>';
	}
});

Route::filter('test', function () {
	
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});
