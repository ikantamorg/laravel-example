<?php

class Core_Add_Owner_Id_To_Songs_Videos {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_songs', function ($t) {
			$t->integer('owner_id')->index();
		});

		Schema::table('core_videos', function ($t) {
			$t->integer('owner_id')->index();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('core_songs', function ($t) {
			$t->drop_column('owner_id');
		});

		Schema::table('core_videos', function ($t) {
			$t->drop_column('owner_id');
		});
	}

}