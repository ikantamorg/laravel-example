<?php

class Core_Artist_Genre {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_artist_genre', function ($t) {
			$t->increments('id')->unsigned();
			$t->integer('artist_id');
			$t->integer('genre_id');
			$t->unique(['artist_id', 'genre_id']);
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
		Schema::drop('core_artist_genre');
	}

}