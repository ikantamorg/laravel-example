<?php

class Core_Add_Tag_Types_Classifier {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_tags', function ($t) {
			$t->integer('type_id')->index();
		});

		Schema::create('core_tag_types', function ($t) {
			$t->increments('id')->unsigned();
			$t->string('name');
			$t->boolean('active')->nullable();
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
		Schema::table('core_tags', function ($t) {
			$t->drop_column(['type_id']);
		});

		Schema::drop('core_tag_types');
	}

}