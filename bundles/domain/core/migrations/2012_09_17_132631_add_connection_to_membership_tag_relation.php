<?php

class Core_Add_Connection_To_Membership_Tag_Relation {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_industry_membership_membership_tag', function ($t) {
			$t->integer('industry_player_id')->nullable();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('core_industry_membership_membership_tag', function ($t) {
			$t->drop_column('industry_player_id');
		});
	}

}