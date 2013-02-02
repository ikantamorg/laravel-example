<?php

class Core_Artist_Video {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_artist_video', function ($t) {
			$t->increments('id')->unsigned();
			$t->integer('artist_id');
			$t->integer('video_id');
			$t->unique(['artist_id', 'video_id']);
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
		Schema::drop('core_artist_video');
	}

}