<?php

class Core_Tagables {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_tagables', function ($t) {
			$t->increments('id')->unsigned();
			$t->string('name');
			$t->string('slug');
			$t->integer('primary_tag_type_id');
			$t->boolean('active')->nullable();
			$t->timestamps();

			$t->unique('slug');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_tagables');
	}

}