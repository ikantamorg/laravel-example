<?php

Autoloader::map(array(
	'ActionFilter\\Filter' => Bundle::path('actionfilter').'filter'.EXT,
	'ActionFilter\\FilterCollection' => Bundle::path('actionfilter').'filtercollection'.EXT,
	'ActionFilter\\Filterable' => Bundle::path('actionfilter').'filterable.trait'.EXT,
	'ActionFilter\\Filterable_Controller' => Bundle::path('actionfilter').'filterable.controller'.EXT
));

Autoloader::alias('ActionFilter\\Filter', 'ActionFilter');
Autoloader::alias('ActionFilter\\FilterCollection', 'ActionFilterCollection');
Autoloader::alias('ActionFilter\\Filterable', 'Filterable');
Autoloader::alias('ActionFilter\\Filterable_Controller', 'Filterable_Controller');
