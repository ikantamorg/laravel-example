<?php

class Core_Artist_Types {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_artist_types', function ($t) {
			$t->increments('id')->unsigned();
			$t->string('name');
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
		Schema::drop('core_artist_types');
	}

}