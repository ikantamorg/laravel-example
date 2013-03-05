<?php

class Core_Add_Creator_To_Photos {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_photos', function ($t) {
			$t->integer('creator_id')->nullable();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('core_photos', function ($t) {
			$t->drop_column('creator_id');
		});
	}

}