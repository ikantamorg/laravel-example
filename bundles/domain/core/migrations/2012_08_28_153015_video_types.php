<?php

class Core_Video_Types {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_video_types', function ($t) {
			$t->increments('id');
			$t->string('name');
			$t->timestamps();
		});

		Schema::table('core_videos', function ($t) {
			$t->integer('type_id')->nullable()->index();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('core_video_types');
		
		Schema::table('core_videos', function ($t) {
			$t->drop_column('type_id');
		});
	}

}