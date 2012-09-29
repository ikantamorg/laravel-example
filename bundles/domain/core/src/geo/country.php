<?php

namespace Core\Geo;

use Core\Abstracts;

class Country extends Abstracts\Model
{
	public static $table = 'core_countries';

	public static $accessible = ['name'];

	/**Relations and Setters/Getters**/

	public function cities()
	{
		return $this->has_many('\\Core\\Geo\\City', 'country_id');
	}
}