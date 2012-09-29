<?php

namespace Core\User;

use Core\Abstracts;
use Hash;

class Model extends Abstracts\Model
{
	public static $table = 'core_users';

	public static $accessible = [];

	protected $_repeated_password = null;

	public function before_validation()
	{
		$this->set_validation([
			'password' => 'required|in:'.$this->repeated_password,
			'username' => 'required|max:200',
			'email'    => 'required|email|max:200|unique:'.$this->table()
		]);
	}

	public function before_save()
	{
		if( ! $this->exists or array_get($this->get_dirty(), 'password') )
			$this->attributes['password'] = Hash::make($this->attributes['password']);
	}

	public function before_delete()
	{
		$this->roles()->sync([]);
	}

	/**Relations and Setters/Getters**/
	public function roles()
	{
		return $this->has_many_and_belongs_to('Core\\User\\Role', 'core_user_role', 'user_id', 'role_id');
	}

	public function set_repeated_password($val)
	{
		$this->_repeated_password = $val;
	}

	public function get_repeated_password()
	{
		return $this->_repeated_password;
	}
}