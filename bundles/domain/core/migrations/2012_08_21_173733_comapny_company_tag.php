<?php

class Core_Comapny_Company_Tag {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_company_company_tag', function ($t) {
			$t->increments('id');
			$t->integer('company_id');
			$t->integer('tag_id');
			$t->timestamps();

			$t->unique(['company_id', 'tag_id']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_company_company_tag');
	}

}