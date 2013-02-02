<?php

class Core_Add_Event_Type {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_event_types', function ($t) {
			$t->increments('id');
			$t->string('name');
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
		Schema::drop('core_event_types');
	}

}