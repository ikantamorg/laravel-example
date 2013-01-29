<?php

Bundle::start('core');

use Core\User\Role;

class Admin_Rolesfix_Task
{
	public function run()
	{
		if(DB::table('core_roles')->where_global(1)->first())
			throw new Exception('Roles fix has been run once. It cannot be run again');

		DB::table('core_roles')->update(['global' => 1]);
		echo 'Roles fixed.'."\n";
	}
}