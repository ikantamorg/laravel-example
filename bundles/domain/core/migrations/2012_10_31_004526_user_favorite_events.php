<?php

class Core_User_Favorite_Events {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_user_favorite_events', function ($t) {
			$t->increments('id');
			$t->integer('user_id');
			$t->integer('event_id');
			$t->timestamps();

			$t->unique(['user_id', 'event_id']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_user_favorite_events');
	}

}