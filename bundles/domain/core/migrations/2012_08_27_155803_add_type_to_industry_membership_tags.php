<?php

class Core_Add_Type_To_Industry_Membership_Tags {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_industry_membership_tags', function ($t) {
			$t->string('type')->nullable();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('core_industry_membership_tags', function ($t) {
			$t->drop_column('type');
		});
	}

}