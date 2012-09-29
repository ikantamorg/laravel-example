<?php

namespace Core\IndustryMember;

use Core\Abstracts;

class Membership extends Abstracts\Model
{
	public static $table = 'core_industry_memberships';

	public static $accessible = [];

	public function before_delete()
	{
		$this->tags()->sync([]);
	}

	/**Relations and Setters/Getters**/

	public function industry_member_profile()
	{
		return $this->belongs_to('Core\\IndustryMember\\Profile', 'industry_member_id');
	}

	public function industry_register_entry()
	{
		return $this->belongs_to('Core\\IndustryPlayer\\RegisterEntry', 'industry_register_entry_id');
	}

	public function tags()
	{
		return $this->has_many_and_belongs_to(
			'Core\\IndustryMember\\MembershipTag',
			'core_industry_membership_membership_tag',
			'industry_membership_id',
			'membership_tag_id'
		);
	}

	public function membership_tag_connections()
	{
		return $this->has_many('Core\\IndustryMember\\MembershipTagConnection', 'industry_membership_id');
	}
}