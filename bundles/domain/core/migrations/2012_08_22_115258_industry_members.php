<?php

class Core_Industry_Members {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_industry_members', function ($t) {
			$t->increments('id');
			$t->string('name');
			$t->string('email')->nullable();
			$t->string('phone')->nullable();
			$t->string('address')->nullable();
			$t->string('facebook_url')->nullable();
			$t->integer('country_id')->nullable();
			$t->integer('city_id')->nullable();
			$t->integer('user_id')->nullalble();
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
		Schema::drop('core_industry_members');
	}

}