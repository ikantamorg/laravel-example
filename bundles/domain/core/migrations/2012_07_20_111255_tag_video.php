<?php

class Core_Tag_Video {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_tag_video', function ($t) {
			$t->increments('id')->unsigned();
			$t->integer('tag_id');
			$t->integer('video_id');
			$t->unique(['tag_id', 'video_id']);
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
		SChema::drop('core_tag_video');
	}

}