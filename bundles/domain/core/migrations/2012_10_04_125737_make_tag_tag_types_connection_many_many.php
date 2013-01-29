<?php

class Core_Make_Tag_Tag_Types_Connection_Many_Many {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_tags', function ($t) {
			$t->drop_column('type_id');
		});

		Schema::create('core_tag_tag_type', function ($t) {
			$t->increments('id');
			$t->integer('tag_id');
			$t->integer('tag_type_id');
			$t->timestamps();
			$t->unique(['tag_id', 'tag_type_id']);
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
			$t->integer('type_id')->nullable()->index();
		});

		Schema::drop('core_tag_tag_type');
	}

}