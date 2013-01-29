<?php

namespace Core\IndustryMember;

use Core\Abstracts;

class MembershipTag extends Abstracts\Model
{
	public static $table = 'core_industry_membership_tags';

	public static $accessible = [];

	public function before_delete()
	{
		$this->memberships()->sync([]);
	}

	/**Relations and Setters/Getters**/

	public function memberships()
	{
		return $this->has_many_and_belongs_to(
			'Core\\IndustryMember\\Membership',
			'core_industry_membership_membership_tag',
			'membership_tag_id',
			'industry_membership_id'
		);
	}

	public function membership_tag_connections()
	{
		return $this->has_many('Core\\IndustryMember\\MebershipTagConnection', 'membership_tag_id');
	}
}