<?php

class Core_Make_Events_Contactable {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_events', function ($t) {
			$t->string('contact_emails', 500);
			$t->string('contact_numbers', 500);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('core_events', function ($t) {
			$t->drop_column(['contact_emails', 'contact_numbers']);
		});
	}

}