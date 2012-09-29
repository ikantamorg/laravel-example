<?php

class Core_Song_Genre {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_song_genre', function ($t) {
			$t->increments('id')->unsigned();
			$t->integer('song_id');
			$t->integer('genre_id');
			$t->unique(['song_id', 'genre_id']);
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
		Schema::drop('core_song_genre');
	}

}