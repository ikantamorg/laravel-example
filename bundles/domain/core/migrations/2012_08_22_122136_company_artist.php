<?php

class Core_Company_Artist {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_company_artist', function ($t) {
			$t->increments('id');
			$t->integer('company_id');
			$t->integer('artist_id');
			$t->timestamps();

			$t->unique(['company_id', 'artist_id']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_company_artist');
	}

}