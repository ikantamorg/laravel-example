<?php

class Core_Industry_Players {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('core_industry_players_register', function ($t) {
			$t->increments('id')->unsigned();
			$t->integer('industry_player_id');
			$t->string('type');
			$t->string('name');
			$t->string('profile_pic');
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
		Schema::drop('core_industry_players_register');
	}
}