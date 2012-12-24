<?php

class Core_Company_Venue {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_company_venue', function ($t) {
			$t->increments('id');
			$t->integer('company_id');
			$t->integer('venue_id');
			$t->timestamps();

			$t->unique(['company_id', 'venue_id']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_company_venue');
	}

}