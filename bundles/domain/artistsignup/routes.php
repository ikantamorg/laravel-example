<?php

use Core\User\Model as User;
use OneAuth\Auth\Client;

Route::get('artistsignup/auth/register', function () {
	if( Auth::check() )
		return Redirect::to('artistsignup/selection');

	if(! Session::get('oneauth') )
		return Response::error(404);

	if( ! $client = Client::where_provider(Session::get('oneauth.provider'))->where_uid(Session::get('oneauth.info.uid'))->first() )
		return Response::error(404);

	if( $user = User::where_email(Session::get('oneauth.info.email'))->first() ) {
		Auth::login($user->id);
		return Redirect::to_action('auth@merge_accounts');
	}

	$user = ArtistSignup\App::register_user_via_oauth();
	$client->user_id = $user->id;

	Auth::login($user->id);

	return Redirect::to('artistsignup/selection');
});