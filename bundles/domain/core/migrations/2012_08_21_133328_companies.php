<?php

class Core_Companies {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_companies', function ($t) {
			$t->increments('id');
			$t->string('name');
			$t->text('about');
			$t->string('contact_number')->nullable();
			$t->string('contact_email')->nullable();
			$t->integer('creator_id')->nullable();
			$t->boolean('manages_artists')->nullable();
			$t->boolean('manages_venues')->nullable();
			$t->boolean('manages_events')->nullable();
			$t->boolean('claimed');
			$t->boolean('active')->nullable();

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
		Schema::drop('core_companies');
	}

}