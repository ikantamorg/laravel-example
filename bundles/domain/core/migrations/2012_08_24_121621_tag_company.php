<?php

class Core_Tag_Company {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_tag_company', function ($t) {
			$t->increments('id');
			$t->integer('tag_id');
			$t->integer('company_id');
			$t->timestamps();

			$t->unique(['tag_id', 'company_id']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_tag_company');
	}

}