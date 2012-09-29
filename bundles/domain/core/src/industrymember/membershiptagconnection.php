<?php

namespace Core\IndustryMember;

use Core\Abstracts;

class MembershipTagConnection extends Abstracts\Model
{
	public static $table = 'core_industry_membership_membership_tag';

	/**Setters Getters and Relationships**/

	public function industry_membership()
	{
		return $this->belongs_to('Core\\IndustryMember\\Membership', 'industry_membership_id');
	}

	public function membership_tag()
	{
		return $this->belongs_to('Core\\IndustryMember\\MembershipTag', 'membership_tag_id');
	}

	public function connected_industry_player()
	{
		return $this->belongs_to('Core\\IndustryPlayer\\RegisterEntry', 'industry_player_id');
	}
}