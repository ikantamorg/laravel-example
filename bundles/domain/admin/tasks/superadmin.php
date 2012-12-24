<?php

Bundle::start('core');

use Core\User\Model as User;
use Core\User\Role;

class Admin_Superadmin_Task
{
	protected $_superadmin_username = 'superadmin';
	protected $_superadmin_email = 'superadmin@musejam.com';
	protected $_superadmin_pwd = 'MUSEJAM2012';

	protected function check_existance()
	{
		if($user = User::where_email('superadmin@musejam.com')->first())
			throw new Exception('A Superadmin has already been created using this task. You Cannot create another this way.');

		echo 'Default Superadmin does not exist yet. Creating a new one.'."\n";
	}

	protected function create()
	{
		$user = new User;
		$user->username = $this->_superadmin_username;
		$user->email = $this->_superadmin_email;
		$user->password = $this->_superadmin_pwd;
		$user->repeated_password = $this->_superadmin_pwd;
		$user->save();

		echo 'Default superadmin created with attributes:'."\n\n";
		echo "Username: '{$this->_superadmin_username}'\n";
		echo "Email: '{$this->_superadmin_email}'\n";
		echo "Password: '{$this->_superadmin_pwd}'\n";
		return $user;
	}

	protected function give_superadmin_role_to($user)
	{
		if( ! $role = Role::where_name('superadmin')->first() )
		{
			$role = new Role;
			$role->name = 'superadmin';
			$role->save();
		}
		
		if(! in_array($role->id, array_map(function($r) { return $r->id; }, $user->roles)) )
			$user->roles()->attach($role->id);
	}

	public function setup()
	{
		$this->check_existance();
		$superadmin = $this->create();
		$this->give_superadmin_role_to($superadmin);
	}
}
