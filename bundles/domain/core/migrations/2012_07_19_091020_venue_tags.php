<?php

class Core_Venue_Tags {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_venue_tags', function ($t) {
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
		Schema::drop('core_venue_tags');
	}
}