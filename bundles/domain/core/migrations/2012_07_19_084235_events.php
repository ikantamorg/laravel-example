<?php

class Core_Events {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_events', function ($t) {
			$t->increments('id')->unsigned();
			$t->string('name');
			$t->string('profile_pic');
			$t->string('type');
			$t->integer('start_time');
			$t->integer('end_time');
			$t->text('about');
			$t->string('website_url')->nullable();
			$t->string('facebook_url')->nullable();
			$t->string('soundcloud_url')->nullable();
			$t->string('source');
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
		Schema::drop('core_events');
	}

}