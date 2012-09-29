<?php

class Core_Video_Genre {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_video_genre', function ($t) {
			$t->increments('id')->unsigned();
			$t->integer('video_id');
			$t->integer('genre_id');
			$t->unique(['video_id', 'genre_id']);
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
		Schema::drop('core_video_genre');
	}

}