<?php

class Core_Add_City_To_Companies {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_companies', function ($t) {
			$t->integer('city_id');
			$t->index('city_id');
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
			$t->drop_column('city_id');
		});
	}

}