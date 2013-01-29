<?php

class Core_Make_Event_Date_Times_Strings {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_events', function ($t) {
			$t->drop_column(['date', 'start_time', 'end_time']);
		});

		Schema::table('core_events', function ($t) {
			$t->string('date', 40);
			$t->string('start_time', 40);
			$t->string('end_time', 40);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('core_events', function ($t) {
			$t->drop_column(['date', 'start_time', 'end_time']);
		});

		Schema::table('core_events', function ($t) {
			$t->date('date');
			$t->timestamp('start_time');
			$t->string('end_time');
		});
	}

}