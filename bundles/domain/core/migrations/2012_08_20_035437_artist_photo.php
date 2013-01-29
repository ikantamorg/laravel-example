<?php

class Core_Artist_Photo {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_artist_photo', function ($t) {
			$t->increments('id');
			$t->integer('artist_id');
			$t->integer('photo_id');
			$t->timestamps();

			$t->unique(['artist_id', 'photo_id']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_artist_photo');
	}

}