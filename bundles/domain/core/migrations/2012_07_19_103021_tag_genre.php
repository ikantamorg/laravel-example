<?php

class Core_Tag_Genre {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_tag_genre', function ($t) {
			$t->increments('id')->unsigned();
			$t->integer('tag_id');
			$t->integer('genre_id');
			$t->unique(['tag_id', 'genre_id']);
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
		Schema::drop('core_tag_genre');
	}

}