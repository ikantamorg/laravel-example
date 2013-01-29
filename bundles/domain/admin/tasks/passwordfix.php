<?php
Bundle::start('core');
use Core\User\Model as User;

class Admin_Passwordfix_Task
{
	public function run()
	{
		$users = User::all();

		foreach($users as $u)
		{
			if($u->username === 'arnab')
				continue;

			$u->password = 'Muselize2011';
			$u->save();
		}
	}
}