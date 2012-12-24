<?php

class Core_Event_Artist {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_event_artist', function ($t) {
			$t->increments('id')->unsigned();
			$t->integer('event_id');
			$t->integer('artist_id');
			$t->unique(['event_id', 'artist_id']);
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
		Schema::drop('core_event_artist');
	}

}