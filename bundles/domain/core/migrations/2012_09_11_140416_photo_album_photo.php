<?php

class Core_Photo_Album_Photo {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_photo_album_photo', function ($t) {
			$t->increments('id');
			$t->integer('photo_album_id');
			$t->integer('photo_id');
			$t->timestamps();

			$t->unique(['photo_album_id', 'photo_id']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_photo_album_photo');
	}

}