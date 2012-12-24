<?php

class Core_Featured_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_featured', function ($t) {
			$t->increments('id');
			$t->string('type');
			$t->integer('resource_id');
			$t->timestamps();

			$t->unique(['type', 'resource_id']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_featured');
	}

}