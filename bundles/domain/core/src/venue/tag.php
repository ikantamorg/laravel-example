<?php

namespace Core\Venue;

use Core\Abstracts;

class Tag extends Abstracts\Model
{
	public static $table = 'core_venue_tags';

	public static $accessible = ['name'];

	public function before_delete()
	{
		$this->venues()->sync([]);
	}

	/**Relations and Setters/Getters**/

	public function venues()
	{
		return $this->has_many_and_belongs_to('\\Core\\Venue\\Model', 'core_venue_venue_tag', 'venue_tag_id', 'venue_id');
	}
}