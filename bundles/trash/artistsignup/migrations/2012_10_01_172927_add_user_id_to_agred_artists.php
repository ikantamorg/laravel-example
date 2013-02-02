<?php

Bundle::start('artistsignup');

class Artistsignup_Add_User_Id_To_Agred_Artists {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table(Config::get('artistsignup::settings.database.table'), function ($t) {
			$t->integer('user_id');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table(Config::get('artistsignup::settings.database.table'), function ($t) {
			$t->drop_column('user_id');
		});
	}

}