<?php

//Route::controller(Controller::detect('admin'));

Route::get('(:bundle)', function () {
	return Redirect::to(URL::to('admin/dashboard'));
});


Route::controller(Controller::detect('admin'));



View::composer('admin::layout', function ($view) {

	Asset::container('admin-common')
			->add('bs-css', 'css/bootstrap.min.css')
			->add('fonts', 'css/fonts.css', 'bs-css')
			->add('chosen-css', 'css/chosen.css')
			->add('jquery', 'js/jquery.min.js', 'fonts')
			->add('chosen-js', 'js/chosen.jquery.min.js', 'chosen-css')
			->add('bs-js', 'js/bootstrap.min.js', 'jquery')
			->add('json2', 'js/json2.js', 'bs-js')
			->add('us', 'js/underscore.js', 'json2')
			->add('bb', 'js/backbone.js', 'us')
			->add('datepicker-css', 'css/datepicker.css', 'bs-css')
			->add('datepicker-js', 'js/bootstrap-datepicker.js', 'datepicker-css');


	Asset::container('admin-app')
			->bundle('admin')
			->add('fg-css', 'css/flexigrid.pack.css')
			->add('style', 'css/style.css', 'fg-css')
			->add('fg-js', 'js/flexigrid.pack.js', 'style')
			->add('ts-js', 'js/table-sorter.js', 'style')
			->add('img-pre', 'js/img-prefixer.js', 'ts-js')
			->add('chosen-init', 'js/chosen-init.js', 'style')
			->add('nav-handler', 'js/nav-handler.js', 'chosen-init');
});