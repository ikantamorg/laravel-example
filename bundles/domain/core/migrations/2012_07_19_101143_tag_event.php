<?php

class Core_Tag_Event {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_tag_event', function ($t) {
			$t->increments('id')->unsigned();
			$t->integer('tag_id');
			$t->integer('event_id');
			$t->unique(['tag_id', 'event_id']);
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
		Schema::drop('core_tag_event');
	}

}