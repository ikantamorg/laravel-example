<?php

namespace Core\Event;

use Core\Abstracts;

class Type extends Abstracts\Model
{
	public static $table = 'core_event_types';

	public function events()
	{
		return $this->has_many('Core\\Event\\Model', 'type_id');
	}
}