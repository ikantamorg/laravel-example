<?php

class Core_Company_Event {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_company_event', function ($t) {
			$t->increments('id');
			$t->integer('company_id');
			$t->integer('event_id');
			$t->timestamps();

			$t->unique(['company_id', 'event_id']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_company_event');
	}

}