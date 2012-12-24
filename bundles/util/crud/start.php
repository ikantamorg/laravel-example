<?php

Autoloader::map(['Crud_Base_Controller' => Bundle::path('crud') . 'controllers' . DS . 'base.php']);
Autoloader::namespaces([
	'Crud' => Bundle::path('crud').'src'
]);

if(! function_exists('eloquent_to_array') )
{
	function eloquent_to_array($models)
	{
		if ($models instanceof Laravel\Database\Eloquent\Model)
		{
			return $models->to_array();
		}

		return array_map(function($m) { return $m->to_array(); }, (array)$models);
	}
}

View::composer('crud::layout', function ($view) {

	Asset::container('crud-common')->add('bs-css', 'css/bootstrap.min.css')
								   ->add('fonts', 'css/fonts.css', 'bs-css')
								   ->add('style', 'css/style.css', 'fonts')
								   ->add('jquery', 'js/jquery-1.7.2.min.js', 'style')
								   ->add('bs-js', 'js/bootstrap.min.js', 'jquery')
								   ->add('json2', 'js/json2.js', 'bs-js')
								   ->add('us', 'js/underscore.js', 'json2')
								   ->add('bb', 'js/backbone.js', 'us');

});