<?php

class Core_Tagable_Tag_Type {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_tagable_tag_type', function ($t) {
			$t->increments('id')->unsigned();
			$t->integer('tag_type_id');
			$t->integer('tagable_id');
			$t->timestamps();

			$t->unique(['tag_type_id', 'tagable_id']);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_tagable_tag_type');
	}

}