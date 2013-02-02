<?php

class Core_Add_Website_To_Company {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_companies', function ($t) {
			$t->string('website');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('core_companies', function ($t) {
			$t->drop_column('website');
		});
	}

}