<?php

class Core_Add_Album_Cover {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_photo_albums', function ($t) {
			$t->integer('cover_photo_id')->nullable();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('core_photo_albums', function ($t) {
			$t->drop_column('cover_photo_id');
		});
	}

}