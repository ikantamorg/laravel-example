<?php

Bundle::start('artistsignup');

class Artistsignup_Agreed_Artists_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(Config::get('artistsignup::settings.database.table'), function ($t) {
			$t->increments('id');
			$t->integer('artist_id')->unique();
			$t->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop(Config::get('artistsignup::settings.database.table'));
	}

}