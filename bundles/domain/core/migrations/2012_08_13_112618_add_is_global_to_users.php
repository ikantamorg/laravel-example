<?php

class Core_Add_Is_Global_To_Users {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_roles', function ($t) {
			$t->boolean('global');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('core_roles', function ($t) {
			$t->drop_column(['global']);
		});
	}

}