<?php

/*
|--------------------------------------------------------------------------
| Bundle Configuration
|--------------------------------------------------------------------------
|
| Bundles allow you to conveniently extend and organize your application.
| Think of bundles as self-contained applications. They can have routes,
| controllers, models, views, configuration, etc. You can even create
| your own bundles to share with the Laravel community.
|
| This is a list of the bundles installed for your application and tells
| Laravel the location of the bundle's root directory, as well as the
| root URI the bundle responds to.
|
| For example, if you have an "admin" bundle located in "bundles/admin" 
| that you want to handle requests with URIs that begin with "admin",
| simply add it to the array like this:
|
|		'admin' => [
|			'location' => 'admin',
|			'handles'  => 'admin',
|		],
|
| Note that the "location" is relative to the "bundles" directory.
| Now the bundle will be recognized by Laravel and will be able
| to respond to requests beginning with "admin"!
|
| Have a bundle that lives in the root of the bundle directory
| and doesn't respond to any requests? Just add the bundle
| name to the array and we'll take care of the rest.
|
*/

return [

	'docs' => ['handles' => 'docs', 'location' => 'util/docs'],
	
	'rouilder' => ['auto' => true, 'location' => 'util/rouilder'],
	'crud' => ['auto' => true, 'location' => 'util/crud'],
	'gatekeeper' => ['auto' => true, 'location' => 'util/gatekeeper'],
	'bouncer'  => ['auto' => true, 'location' => 'util/bouncer'],
	'actionfilter' => ['auto' => true, 'location' => 'util/actionfilter'],
	'laraveless' => ['auto' => true, 'location' => 'util/laraveless'],
	'hybrid' => ['auto' => true, 'location' => 'util/hybrid'],
	'uploader' => ['auto' => true, 'location' => 'util/uploader'],
	'recaptcha' => ['auto' => true, 'location' => 'util/recaptcha'],
	'oneauth'  => ['auto' => true, 'location' => 'util/oneauth'],

	'core' => ['auto' => true, 'location' => 'domain/core'],
	'admin' => ['auto' => true, 'handles' => 'admin', 'location' => 'domain/admin'],
	'repositories' => ['auto' => true, 'location' => 'domain/repositories'],
	'dashboard' => ['auto' => true, 'location' => 'domain/dashboard', 'handles' => 'dashboard']
];