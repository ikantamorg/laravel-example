<?php

namespace Repository;

use Core\Artist\Model;

class Artists extends Base
{
	protected $_eager_loads = [
		'featured_songs',
		'profile_photo'
	];

	protected function q()
	{
		$q = Model::where(Model::$table.'.active', '=', 1)->select(Model::$table.'.*');

		return $q;
	}

	protected function filtered_q()
	{
		$params = $this->_filter;

		if(array_key_exists('tags', $params)) {
			return $this->add_tag_constraints($this->q(), (array) $params['tags']);			
		} else {
			return $this->q();
		}
	}
}