<?php

Autoloader::namespaces([
	'Repository' => Bundle::path('repositories') . 'src'
]);

Autoloader::map([
	'Repository' => Bundle::path('repositories') . 'repository.php'
]);