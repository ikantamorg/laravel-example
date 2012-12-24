<?php

class Core_Membership_Types {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_industry_membership_types', function ($t) {
			$t->increments('id');
			$t->string('name');
			$t->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_industry_membership_types');
	}

}