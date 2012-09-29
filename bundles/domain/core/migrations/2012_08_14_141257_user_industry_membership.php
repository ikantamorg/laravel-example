<?php

class Core_User_Industry_Membership {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_user_industry_membership', function ($t) {
			$t->increments('id');
			$t->integer('user_id');
			$t->integer('industry_register_entry_id');
			$t->timestamps();

			$t->unique(['user_id', 'industry_register_entry_id'], 'user_id_register_entry_id');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_user_industry_membership');
	}

}