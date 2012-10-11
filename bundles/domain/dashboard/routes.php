<?php


Route::controller(Controller::detect('dashboard'));

Route::get('(:bundle)', ['uses' => 'dashboard::home@index']);

View::composer('dashboard::common.left-pane', function ($view) {
	
});