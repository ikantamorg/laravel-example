<?php

class Core_Genres {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_genres', function ($t) {
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
		Schema::drop('core_genres');
	}

}