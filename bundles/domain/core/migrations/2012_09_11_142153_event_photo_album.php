<?php

class Core_Event_Photo_Album {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_event_photo_album', function ($t) {
			$t->increments('id');
			$t->integer('event_id');
			$t->integer('photo_album_id');
			$t->timestamps();

			$t->unique(['event_id', 'photo_album_id']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_event_photo_album');
	}

}