<?php

class Core_Artist_Featured_Songs {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_artist_featured_songs', function ($t) {
			$t->increments('id');
			$t->integer('artist_id');
			$t->integer('song_id');
			$t->timestamps();
			$t->unique(['artist_id', 'song_id']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_artist_featured_songs');
	}

}