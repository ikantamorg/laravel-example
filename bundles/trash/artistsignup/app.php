<?php

namespace ArtistSignup;

use Config;
use Session;
use Core\User\Model as User;

class App
{
	protected static $_is_setup = false;
	
	public static function setup()
	{
		if(static::$_is_setup)
			return;
		
		Config::set('oneauth::urls.registration', 'artistsignup/auth/register');
		Config::set('oneauth::urls.login', 'artistsignup');
		Config::set('oneauth::urls.callback', 'connect/callback');
		Config::set('oneauth::urls.registered', 'artistsignup/selection');
		Config::set('oneauth::urls.logged_in', 'artistsignup/selection');

		static::$_is_setup = true;
	}

	public static function register_user_via_oauth()
	{
		$user = new User;
		$user->username = Session::get('oneauth.info.name');
		$user->email = Session::get('oneauth.info.email');
		$user->password = static::random_password();
		$user->repeated_password = $user->password;
		$user->password_set_manually = false;

		if(! $user->save() )
			dd($user->errors);

		return $user;
	}

	protected static function random_password()
	{
		return hash('crc32', microtime(true));
	}
}