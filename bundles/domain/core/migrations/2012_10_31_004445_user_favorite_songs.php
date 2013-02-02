<?php

class Core_User_Favorite_Songs {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_user_favorite_songs', function ($t) {
			$t->increments('id');
			$t->integer('user_id');
			$t->integer('song_id');
			$t->timestamps();

			$t->unique(['user_id', 'song_id']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_user_favorite_songs');
	}

}