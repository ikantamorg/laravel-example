<?php

class Core_Event_Organizers_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_event_organizers', function ($t) {
			$t->increments('id');
			$t->integer('event_id');
			$t->integer('company_id');
			$t->integer('industry_member_id');
			$t->boolean('active');
			$t->timestamps();

			$t->unique(['event_id', 'company_id', 'industry_member_id'], 'event_company_industry_member');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_event_organizers');
	}

}