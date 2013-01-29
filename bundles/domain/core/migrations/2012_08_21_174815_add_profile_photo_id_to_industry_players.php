<?php

class Core_Add_Profile_Photo_Id_To_Industry_Players {

	protected $tables = [
		'core_artists',
		'core_venues',
		'core_events',
		'core_industry_players_register',
		'core_companies',
	];

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		foreach($this->tables as $t) {
			Schema::table($t, function ($t) {
				$t->integer('profile_photo_id');
			});
		}
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		foreach($this->tables as $t) {
			Schema::table($t, function ($t) {
				$t->drop_column('profile_photo_id');
			});
		}
	}

}