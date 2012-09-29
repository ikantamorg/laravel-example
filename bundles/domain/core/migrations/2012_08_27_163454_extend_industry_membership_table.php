<?php

class Core_Extend_Industry_Membership_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_industry_memberships', function ($t) {
			$t->string('description');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('core_industry_memberships', function ($t) {
			$t->drop_column('description');
		});
	}

}