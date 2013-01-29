<?php

class Core_Add_Admin_Flag_To_Memberhsips {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_industry_memberships', function ($t) {
			$t->boolean('admin');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('core_industry_memberships', function ($t) {
			$t->drop_column(['admin']);
		});
	}

}