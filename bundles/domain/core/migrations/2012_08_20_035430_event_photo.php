<?php

class Core_Event_Photo {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_event_photo', function ($t) {
			$t->increments('id');
			$t->integer('event_id');
			$t->integer('photo_id');
			$t->timestamps();

			$t->unique(['event_id', 'photo_id']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_event_photo');
	}

}