<?php

class Core_Photos {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_photos', function ($t) {
			$t->increments('id');
			$t->string('resource');
			$t->integer('owner_id');
			$t->string('about');
			$t->string('alt');
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
		Schema::drop('core_photos');
	}

}