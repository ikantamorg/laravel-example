<?php

class Core_Make_Artists_Contactables {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_artists', function ($t) {
			$t->drop_column('contact');
		});

		Schema::table('core_artists', function ($t) {
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
		Schema::table('core_artists', function ($t) {
			$t->drop_column(['contact_emails', 'contact_numbers']);
		});

		Schema::table('core_artists', function ($t) {
			$t->text('contact');
		});
	}

}