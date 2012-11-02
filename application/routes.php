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
	IoC::resolve('common-assets');
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

Route::get('important-cities', function () {

	$cities = Core\Geo\City::with([
				'venues',
				'venues.events' => function ($q) { $q->where('start_time', '>', new DateTime); }
			])->get();

	$get_city_events = function ($c) {
		if(! $c->venues )
			return [];
		$events = [];

		foreach($c->venues as $v)
		{
			$events = array_merge($events, $v->events);
		}

		return $events;
	};

	foreach($cities as $i => $c)
	{
		$events = $get_city_events($c);
		if(count($events) >= 1)
			echo $c->name . " ---- " . count($events) . '<br/>';
	}

});

Route::get('test', function () {
	Config::set('application.profiler', false);
	echo Form::open(URL::to('test'), 'DELETE');
	echo Form::close();
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
