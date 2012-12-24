<?php

class Core_Videos {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_videos', function ($t) {
			$t->increments('id')->unsigned();
			$t->integer('industry_player_id');
			$t->string('name');
			$t->integer('duration');
			$t->string('streaming_url');
			$t->string('provider');
			$t->integer('creator_id')->nullable();
			$t->boolean('active')->nullable();
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
		Schema::drop('core_videos');
	}

}