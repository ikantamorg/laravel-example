<?php

class Core_Industry_Register_Photo_Nullable {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_industry_players_register', function ($t) {
			$t->drop_column('profile_photo_id');
		});
		Schema::table('core_industry_players_register', function ($t) {
			$t->integer('profile_photo_id')->nullable();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('core_industry_players_register', function ($t) {
			$t->drop_column('profile_photo_id');
		});
		Schema::table('core_industry_players_register', function ($t) {
			$t->integer('profile_photo_id');
		});
	}

}