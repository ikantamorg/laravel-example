<?php

class Core_User_Role {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_user_role', function ($t) {
			$t->increments('id')->unsigned();
			$t->integer('user_id');
			$t->integer('role_id');
			$t->timestamps();

			$t->unique(['user_id', 'role_id']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_user_role');
	}

}