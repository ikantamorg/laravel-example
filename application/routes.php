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


Route::filter('ajax', function () {
	if(! Request::ajax() )
		return Response::json(array('error' => 'forbidden'), 403);
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
