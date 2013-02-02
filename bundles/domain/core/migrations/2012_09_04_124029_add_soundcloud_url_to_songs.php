<?php

class Core_Add_Soundcloud_Url_To_Songs {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_songs', function ($t) {
			$t->string('soundcloud_url')->nullable();
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
			$t->drop_column('soundcloud_url');
		});
	}

}