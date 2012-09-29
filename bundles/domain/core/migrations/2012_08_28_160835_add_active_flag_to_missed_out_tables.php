<?php

class Core_Add_Active_Flag_To_Missed_Out_Tables {

	protected $tables = [
		'core_industry_members',
		'core_photos',
		'core_song_types',
		'core_video_types',
		'core_industry_memberships'
	];

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		foreach($this->tables as $table)
			Schema::table($table, function ($t) {
				$t->boolean('active')->nullable();
			});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		foreach($this->tables as $table)
			Schema::table($table, function ($t) {
				$t->drop_column('active');
			});
	}

}