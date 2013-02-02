<?php

class Core_User_Membership_Type_Maps {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_user_industry_membership_membership_type', function ($t) {
			$t->increments('id');
			$t->integer('user_membership_id');
			$t->integer('membership_type_id');
			$t->timestamps();

			$t->unique(['user_membership_id', 'membership_type_id'], 'membership_membership_type');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_user_industry_membership_membership_type');
	}

}