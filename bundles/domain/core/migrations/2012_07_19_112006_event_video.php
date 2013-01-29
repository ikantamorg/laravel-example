<?php

class Core_Event_Video {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_event_video', function ($t) {
			$t->increments('id')->unsigned();
			$t->integer('event_id');
			$t->integer('video_id');
			$t->unique(['event_id', 'video_id']);
			$t->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_event_video');
	}

}