<?php

Autoloader::namespaces([
	'Player' => Bundle::path('player') . 'src'
]);

Autoloader::map([
	'Player_Base_Controller' => Bundle::path('player') . 'controllers' . DS . 'base.php'
]);