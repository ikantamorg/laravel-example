<?php

class Core_Event_Venue {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_event_venue', function ($t) {
			$t->increments('id')->unsigned();
			$t->integer('event_id');
			$t->integer('venue_id');
			$t->unique(['event_id', 'venue_id']);
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
		Schema::drop('core_event_venue');
	}

}