<?php

class Core_Artist_Photo_Album {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_artist_photo_album', function ($t) {
			$t->increments('id');
			$t->integer('artist_id');
			$t->integer('photo_album_id');
			$t->timestamps();

			$t->unique(['artist_id', 'photo_album_id']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_artist_photo_album');
	}

}