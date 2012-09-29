<?php

class Core_Cities {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_cities', function ($t) {
			$t->increments('id')->unsigned();
			$t->integer('country_id')->index();
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
		Schema::drop('core_cities');
	}

}