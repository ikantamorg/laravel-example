<?php

class Core_Event_Song {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_event_song', function ($t) {
			$t->increments('id')->unsigned();
			$t->integer('event_id');
			$t->integer('song_id');
			$t->unique(['event_id', 'song_id']);
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
		Schema::drop('core_event_song');
	}

}