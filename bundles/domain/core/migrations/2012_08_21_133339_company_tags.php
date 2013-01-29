<?php

class Core_Company_Tags {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_company_tags', function ($t) {
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
		Schema::drop('core_company_tags');
	}

}