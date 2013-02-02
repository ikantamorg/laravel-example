<?php

Route::get('dashboard', ['uses' => 'dashboard::home@index']);

Route::controller('dashboard::artists.listing');
Route::controller('dashboard::events.listing');
Route::controller('dashboard::songs.listing');
Route::controller('dashboard::videos.listing');
Route::controller('dashboard::me.favorites');
Route::controller('dashboard::me.settings');

Route::any('dashboard/artists/profile/(:any)/(:any?)', function ($slug, $action = 'index') {
	return Controller::resolve('dashboard', 'artists.profile')->execute($action, [$slug]);
});
Route::any('dashboard/events/profile/(:any)/(:any?)', function ($slug, $action = 'index') {
	return Controller::resolve('dashboard', 'events.profile')->execute($action, [$slug]);
});

Route::get('dashboard/widgets/(:any)', ['uses' => 'dashboard::widgets@widget']);