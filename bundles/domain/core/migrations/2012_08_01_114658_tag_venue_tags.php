<?php

class Core_Tag_Venue_Tags {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_tag_venue_tag', function ($t) {
			$t->increments('id')->unsigned();
			$t->integer('tag_id');
			$t->integer('venue_tag_id');
			$t->timestamps();
			$t->unique(['tag_id', 'venue_tag_id']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_tag_venue_tag');
	}

}