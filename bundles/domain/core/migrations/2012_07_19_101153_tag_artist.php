<?php

class Core_Tag_Artist {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_tag_artist', function ($t) {
			$t->increments('id')->unsigned();
			$t->integer('tag_id');
			$t->integer('artist_id');
			$t->unique(['tag_id', 'artist_id']);
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
		Schema::drop('core_tag_artist');
	}

}