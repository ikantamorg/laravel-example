<?php

class Core_Users {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_users', function ($t) {
			$t->increments('id')->unsigned();
			$t->string('username');
			$t->string('email');
			$t->string('password');
			$t->timestamp('last_login')->nullable();
			$t->timestamp('last_logout')->nullable();
			$t->boolean('active')->nullable();
			$t->timestamps();

			$t->unique(['email']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_users');
	}

}