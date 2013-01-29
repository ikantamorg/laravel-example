<?php

class Core_Add_Youtube_Url_To_Videos {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_videos', function ($t) {
			$t->string('youtube_url')->nullable();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('core_videos', function ($t) {
			$t->drop_column('youtube_url');
		});
	}

}