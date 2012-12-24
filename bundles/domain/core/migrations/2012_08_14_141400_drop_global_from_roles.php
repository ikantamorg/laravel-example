<?php

class Core_Drop_Global_From_Roles {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_roles', function ($t) {
			$t->drop_column(['global']);
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
			$t->boolean('global');
		});
	}

}