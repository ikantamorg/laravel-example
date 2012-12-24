<?php

namespace Repository;

use Core\Tagable\Model;

class Tagables
{
	public function find_by_slug($slug)
	{
		return Model::find_by_slug($slug);
	}
}