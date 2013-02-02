<?php

Autoloader::namespaces([
	'Admin' => Bundle::path('admin') . 'src'
]);

function admin_nav_attr($slug, $full_match = false)
{
	$used_uri = implode('/', array_slice(explode('/', URI::current()), 1));

	$attrs = starts_with($used_uri, $slug) ? ['class' => 'active'] : [];
		
	return HTML::attributes($attrs);
}

function admin_nav_header_attr($slug)
{
	$used_uri = implode('/', array_slice(explode('/', URI::current()), 1));

	$attrs = starts_with($used_uri, $slug) ? ['class' => 'nav-header active selected'] : ['class' => 'nav-header'];

	return HTML::attributes($attrs);
}