<?php

class Core_Add_Different_Player_Urls_To_Videos {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_videos', function ($t) {
			$t->string('iframe_embed_url');
			$t->string('flash_player_url');
			$t->string('chromeless_player_url');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('core_videos', function ($t) {
			$t->drop_column(['iframe_embed_url', 'flash_player_url', 'chromeless_player_url']);
		});
	}

}