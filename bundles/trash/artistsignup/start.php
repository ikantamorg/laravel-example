<?php

Autoloader::map([
	'ArtistSignup\\Controller' => Bundle::path('artistsignup').'controller.php',
	'ArtistSignup\\App'        => Bundle::path('artistsignup').'app.php'
]);

Route::controller('artistsignup');


View::composer('artistsignup::layout', function ($view) {
	Asset::add('bs-css', 'css/bootstrap.min.css')
		 ->add('jquery', 'js/jquery-1.7.2.min.js', 'bs-css')
		 ->add('bs-js', 'js/bootstrap.min.js', 'jquery')
		 ->add('chosen-css', 'css/chosen.css', 'bs-css')
		 ->add('chosen-js', 'js/chosen.jquery.min.js', 'jquery')
	;

	Asset::container('artistsignup')->bundle('artistsignup')
		 ->add('style', 'css/style.css')
		 ->add('script', 'js/script.js')
	;
});

if(Session::started() and Session::has('artistsignup.running')) {
	ArtistSignup\App::setup();
}