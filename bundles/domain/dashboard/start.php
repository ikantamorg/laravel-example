<?php

Autoloader::map([
	'Dashboard_Base_Controller' => Bundle::path('dashboard') . 'controllers/base.php'
]);

View::composer('dashboard::layouts.base', function ($view) {
	IoC::resolve('common-assets');

	Asset::container('dashboard')
		 ->add('style', 'css/style.css');
});

function dashboard_nav_attr($slug)
{

}