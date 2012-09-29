<?php

class Core_Make_Venue_Contact_Details_Extensible {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		$pdo = DB::connection()->pdo;

		foreach(['contact_email', 'contact_number'] as $c) {
			$pdo->query('alter table core_venues change '.$c.' '.Str::plural($c).' VARCHAR(500)');
		}
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		$pdo = DB::connection()->pdo;

		foreach([Str::plural('contact_email'), Str::plural('contact_number')] as $c)
			$pdo->query('alter table core_venues change '.$c.' '.Str::singular($c).' VARCHAR(200)');
	}

}