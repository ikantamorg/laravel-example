<?php

class Core_Drop_Country_Id_From_Industry_Members {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_industry_members', function ($t) {
			$t->drop_column('country_id');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('core_industry_members', function ($t) {
			$t->integer('country_id');
		});
	}

}