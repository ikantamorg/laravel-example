<?php

class Core_Venue_Photo_Album {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_venue_photo_album', function ($t) {
			$t->increments('id');
			$t->integer('venue_id');
			$t->integer('photo_album_id');
			$t->timestamps();

			$t->unique(['venue_id', 'photo_album_id']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_venue_photo_album');
	}

}