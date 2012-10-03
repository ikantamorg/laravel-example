<?php


Route::controller(Controller::detect('dashboard'));

Route::get('(:bundle)', ['uses' => 'dashboard::home@index']);