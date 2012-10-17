<?php

Route::get('(:bundle)', ['uses' => 'dashboard::home@index']);

Route::controller('dashboard::artists.listing');
Route::controller('dashboard::events.listing');
Route::controller('dashboard::songs.listing');
Route::controller('dashboard::videos.listing');

Route::get('(:bundle)/artists/profile/(:any)', ['uses' => 'dashboard::artists.profile@index']);
Route::get('(:bundle)/artists/profile/(:any)/info', ['uses' => 'dashboard::artists.profile@info']);
Route::get('(:bundle)/aritsts/profile/(:any)/songs', ['uses' => 'dashboard::artists.profile@songs']);
Route::get('(:bundle)/artists/profile/(:any)/events', ['uses' => 'dashboard::artists.profile@events']);
Route::get('(:bundle)/artists/profile/(:any)/videos', ['uses' => 'dashboard::artists.profile@videos']);
Route::get('(:bundle)/artists/profile/(:any)/albums', ['uses' => 'dashboard::artists.profile@albums']);

