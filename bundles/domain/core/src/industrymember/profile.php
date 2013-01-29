<?php

namespace Core\IndustryMember;

use DB;
use Core\Abstracts;

class Profile extends Abstracts\Model
{
	public static $table = 'core_industry_members';

	public function before_delete()
	{
		foreach($this->industry_memberships as $m)
			$m->delete();
	}

	public function before_save()
	{
		$this->slugify();
	}

	/**Relations and Setters/Getters**/

	public function industry_memberships()
	{
		return $this->has_many('Core\\IndustryMember\\Membership', 'industry_member_id');
	}

	public function user()
	{
		return $this->belongs_to('Core\\User\\Model', 'user_id');
	}

	public function city()
	{
		return $this->belongs_to('Core\\Geo\\City', 'city_id');
	}
}