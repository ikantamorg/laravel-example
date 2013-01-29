<?php

class Core_Add_Slug_Field_To_Tables {

	protected $tables = [
		'core_artists',
		'core_tags',
		'core_companies',
		'core_events',
		'core_cities',
		'core_industry_members',
		'core_songs',
		'core_videos',
		'core_venues'
	];

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		foreach($this->tables as $t) {
			Schema::table($t, function ($t) {
				$t->string('slug', 250)->nullable()->index();
			});
		}
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		foreach($this->tables as $t) {
			Schema::table($t, function ($t) {
				$t->drop_column('slug');
			});
		}
	}

}