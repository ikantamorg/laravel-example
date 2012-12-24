<?php

namespace Core\User;

use Core\Abstracts;

class Role extends Abstracts\Model
{
	public static $table = 'core_roles';

	public static $accessible = [];

	public function before_delete()
	{
		$this->users()->sync([]);
	}

	/**Relations and Setters/Getters**/
	public function users()
	{
		return $this->has_many_and_belongs_to('\\Core\\User\\Model', 'core_user_role', 'role_id','user_id');
	}
}