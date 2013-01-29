<?php

class Core_Add_Thumbs_To_Song_And_Video {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_songs', function ($t) {
			$t->string('profile_pic');
		});

		Schema::table('core_videos', function ($t) {
			$t->string('profile_pic');
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
			$t->drop_column(['profile_pic']);
		});

		Schema::table('core_videos', function ($t) {
			$t->drop_column(['profile_pic']);
		});
	}

}