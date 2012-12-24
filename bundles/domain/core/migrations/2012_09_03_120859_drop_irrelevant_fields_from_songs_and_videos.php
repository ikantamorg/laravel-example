<?php

class Core_Drop_Irrelevant_Fields_From_Songs_And_Videos {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_songs', function ($t) {
			$t->drop_column(['industry_player_id', 'profile_pic']);
		});

		Schema::table('core_videos', function ($t) {
			$t->drop_column(['industry_player_id', 'profile_pic']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('core_songs', function ($t) {
			$t->integer('industry_player_id');
			$t->string('profile_pic');
		});
		
		Schema::table('core_videos', function ($t) {
			$t->integer('industry_player_id');
			$t->string('profile_pic');
		});
	}

}