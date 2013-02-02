<?php

class Core_Company_Photo {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_company_photo', function ($t) {
			$t->increments('id');
			$t->integer('company_id');
			$t->integer('photo_id');
			$t->timestamps();

			$t->unique(['photo_id', 'company_id']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_company_photo');
	}

}