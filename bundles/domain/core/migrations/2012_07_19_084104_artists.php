<?php

class Core_Artists {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_artists', function ($t) {
			$t->increments('id')->unsigned();
			$t->integer('type_id')->index();
			$t->integer('current_city_id')->index();
			$t->integer('home_city_id')->index();
			$t->string('name');
			$t->text('bio');
			$t->text('contact');
			$t->string('press_contact');
			$t->string('profile_pic');
			$t->string('facebook_url')->nullable();
			$t->string('website_url')->nullable();
			$t->string('soundcloud_url')->nullable();
			$t->string('reverbnation_url')->nullable();
			$t->string('facebook_id')->nullable();
			$t->string('facebook_likes')->nullable();
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
		Schema::drop('core_artists');
	}

}