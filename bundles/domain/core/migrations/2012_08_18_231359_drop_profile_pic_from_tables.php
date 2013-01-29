<?php

class Core_Drop_Profile_Pic_From_Tables {

	protected $tables = [
		'core_artists',
		'core_venues',
		'core_events',
		'core_industry_players_register'
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
				$t->drop_column('profile_pic');
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
				$t->string('profile_pic');
			});
		}
	}

}