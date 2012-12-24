<?php

Autoloader::namespaces(array(
	'Gatekeeper' => Bundle::path('gatekeeper') . 'src'
));

Autoloader::alias('Gatekeeper\\Gatekeeper', 'Gatekeeper');

Route::filter('gatekeeper::pre_login', function () {
	if($uri = Session::get('flash.gatekeeper.inspected-uri'))
		Session::flash('flash.login.redirect-uri', $uri);
});

Autoloader::map(array(
	'Gatekeeper_Gaurded_Controller' => Bundle::path('gatekeeper') . 'controllers' . DS . 'gaurded.php'
));