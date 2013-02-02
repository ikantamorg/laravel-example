<?php

class Core_Add_Password_Set_Manually_Flag_To_Users {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_users', function ($t) {
			$t->boolean('password_set_manually')->nullable();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('core_users', function ($t) {
			$t->drop_column('password_set_manually');
		});
	}

}