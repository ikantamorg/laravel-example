<?php

class Core_Drop_Streaming_Url_From_Videos {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_videos', function ($t) {
			$t->drop_column('streaming_url');
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
			$t->string('core_videos');
		});
	}

}