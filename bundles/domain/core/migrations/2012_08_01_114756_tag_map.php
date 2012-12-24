<?php

class Core_Tag_Map {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_tag_map', function ($t) {
			$t->increments('id')->unsigned();
			$t->integer('tag_a_id');
			$t->integer('tag_b_id');
			$t->integer('tagable_id');
			$t->timestamps();

			$t->unique(['tag_a_id', 'tag_b_id', 'tagable_id']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_tag_map');
	}

}