<?php

class Core_Venue_Venue_Tag {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_venue_venue_tag', function($t) {
			$t->increments('id')->unsigned();
			$t->integer('venue_id');
			$t->integer('venue_tag_id');
			$t->unique(['venue_id', 'venue_tag_id']);
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
		Schema::drop('core_venue_venue_tag');
	}

}