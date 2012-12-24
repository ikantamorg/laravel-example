<?php

class Core_Artist_Song {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_artist_song', function ($t) {
			$t->increments('id')->unsigned();
			$t->integer('artist_id');
			$t->integer('song_id');
			$t->unique(['artist_id', 'song_id']);
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
		Schema::drop('core_artist_song');
	}

}