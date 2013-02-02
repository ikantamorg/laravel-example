<?php

class Core_Add_Cover_Photo_To_Artists {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_artists', function ($t) {
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
		Schema::table('core_artists', function ($t) {
			$t->drop_column('cover_photo_id');
		});
	}

}