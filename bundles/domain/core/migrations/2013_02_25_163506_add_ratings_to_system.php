<?php

class Core_Add_Ratings_To_System {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_artists', function ($t) {
			$t->integer('rating')->nullable();
		});

		Schema::table('core_events', function ($t) {
			$t->integer('rating')->nullable();
		});

		Schema::table('core_videos', function ($t) {
			$t->integer('rating')->nullable();
		});

		Schema::table('core_songs', function ($t) {
			$t->integer('rating')->nullable();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('core_artists', function ($t) {
			$t->drop_column('rating');
		});

		Schema::table('core_events', function ($t) {
			$t->drop_column('rating');
		});

		Schema::table('core_videos', function ($t) {
			$t->drop_column('rating');
		});

		Schema::table('core_songs', function ($t) {
			$t->drop_column('rating');
		});
	}

}