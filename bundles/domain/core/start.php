<?php

Route::controller(Controller::detect());

Autoloader::namespaces([
	'Core' => Bundle::path('core').'src'
]);
