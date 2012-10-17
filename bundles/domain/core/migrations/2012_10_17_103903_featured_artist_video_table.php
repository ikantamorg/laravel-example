<?php

class Core_Featured_Artist_Video_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_event_featured_videos', function ($t) {
			$t->increments('id');
			$t->integer('event_id');
			$t->integer('video_id');
			$t->timestamps();

			$t->unique(['event_id', 'video_id']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_event_featured_videos');
	}

}