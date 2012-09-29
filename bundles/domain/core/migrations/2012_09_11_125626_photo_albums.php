<?php

class Core_Photo_Albums {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_photo_albums', function ($t) {
			$t->increments('id');
			$t->string('name');
			$t->integer('owner_id')->nullable()->index();
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
		Schema::drop('core_photo_albums');
	}

}