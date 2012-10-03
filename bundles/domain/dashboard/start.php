<?php

Autoloader::map([
	'Dashboard_Base_Controller' => Bundle::path('dashboard') . 'controllers/base.php'
]);

View::composer('dashboard::layout', function ($view) {
	IoC::resolve('common-assets');

	Asset::container('dashboard')
		 ->add('style', 'css/style.css');
});