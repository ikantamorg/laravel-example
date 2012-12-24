<?php

class Core_Add_Youtube_Id_To_Videos {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_videos', function ($t) {
			$t->string('youtube_id');
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
			$t->drop_column('youtube_id');
		});
	}

}