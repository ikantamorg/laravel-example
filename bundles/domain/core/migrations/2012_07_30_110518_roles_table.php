<?php

class Core_Roles_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_roles', function ($t) {
			$t->increments('id')->unsigned();
			$t->string('name');
			$t->boolean('active')->nullable();
			$t->timestamps();

			$t->unique(['name']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_roles');
	}

}