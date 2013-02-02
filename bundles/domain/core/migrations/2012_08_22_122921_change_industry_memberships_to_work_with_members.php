<?php

class Core_Change_Industry_Memberships_To_Work_With_Members {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::drop('core_user_industry_membership');

		Schema::create('core_industry_memberships', function ($t) {
			$t->increments('id');
			$t->integer('industry_member_id');
			$t->integer('industry_register_entry_id');
			$t->timestamps();

			$t->unique(['industry_member_id', 'industry_register_entry_id'], 'member_id_register_entry_id');
		});

		/***********/

		Schema::drop('core_user_industry_membership_membership_type');

		Schema::create('core_industry_membership_membership_type', function ($t) {
			$t->increments('id');
			$t->integer('industry_membership_id');
			$t->integer('membership_type_id');
			$t->timestamps();

			$t->unique(['industry_membership_id', 'membership_type_id'], 'membership_membership_type');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::create('core_user_industry_membership', function ($t) {
			$t->increments('id');
			$t->integer('user_id');
			$t->integer('industry_register_entry_id');
			$t->timestamps();

			$t->unique(['user_id', 'industry_register_entry_id'], 'user_id_register_entry_id');
		});

		Schema::drop('core_industry_memberships');

		/************/

		Schema::create('core_user_industry_membership_membership_type', function ($t) {
			$t->increments('id');
			$t->integer('user_membership_id');
			$t->integer('membership_type_id');
			$t->timestamps();

			$t->unique(['user_membership_id', 'membership_type_id'], 'membership_membership_type');
		});

		Schema::drop('core_industry_membership_membership_type');
	}

}