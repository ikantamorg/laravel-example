<?php

//Route::controller(Controller::detect('admin'));

Route::get('(:bundle)', function () {
	return Redirect::to(URL::to('admin/dashboard'));
});


Route::any('admin/event/(:any)/photos/(:any?)/(:any?)', function ($event_id, $action = 'index', $photo_id = null) {
	$controller = Controller::resolve('admin', 'event.photos');
	$controller->set_event_id($event_id);

	return $controller->execute($action, [$photo_id]);
});

Route::controller(Controller::detect('admin'));



View::composer('admin::layout', function ($view) {

	Asset::container('admin-common')
			->add('bs-css', 'css/bootstrap.min.css')
			->add('fonts', 'css/fonts.css', 'bs-css')
			->add('chosen-css', 'css/chosen.css')
			->add('jquery', 'js/lib/jquery.min.js', 'fonts')
			->add('chosen-js', 'js/lib/chosen.jquery.min.js', 'chosen-css')
			->add('bs-js', 'js/lib/bootstrap.min.js', 'jquery')
			->add('json2', 'js/lib/json2.js', 'bs-js')
			->add('us', 'js/lib/underscore.js', 'json2')
			->add('bb', 'js/lib/backbone.js', 'us')
			->add('datepicker-css', 'css/datepicker.css', 'bs-css')
			->add('datepicker-js', 'js/lib/bootstrap-datepicker.js', 'datepicker-css');


	Asset::container('admin-app')
			->bundle('admin')
			->add('style', 'css/style.css', 'fg-css')
			->add('ts-js', 'js/table-sorter.js', 'style')
			->add('img-pre', 'js/img-prefixer.js', 'ts-js')
			->add('chosen-init', 'js/chosen-init.js', 'style')
			->add('nav-handler', 'js/nav-handler.js', 'chosen-init');
});