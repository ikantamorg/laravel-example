<?php

class Core_Add_Contact_Info_To_Venues {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_venues', function ($t) {
			$t->string('contact_number');
			$t->string('contact_email');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('core_venues', function ($t) {
			$t->drop_column(['contact_number', 'contact_email']);
		});
	}

}