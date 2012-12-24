<?php

class Core_Venues {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_venues', function($t) {
			$t->increments('id')->unsigned();
			$t->integer('city_id')->index();
			$t->string('name');
			$t->string('address');
			$t->text('about');
			$t->string('profile_pic');
			$t->string('website')->nullable();
			$t->string('facebook_url')->nullable();
			$t->string('facebook_id')->nullable();
			$t->boolean('claimed');
			$t->integer('creator_id')->nullable();
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
		Schema::drop('core_venues');
	}

}