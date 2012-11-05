<?php

namespace Core\Event;

use Core\Abstracts;

class Organizer extends Abstracts\Model
{
	public static $table = 'core_event_organizers';

	public function event()
	{
		return $this->belongs_to('Core\\Event\\Model', 'event_id');
	}

	public function company()
	{
		return $this->belongs_to('Core\\Company\\Model', 'company_id');
	}

	public function industry_member()
	{
		return $this->belongs_to('Core\\IndustryMember\\Profile', 'industry_member_id');
	}
}