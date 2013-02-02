<?php

class Core_Make_Event_Times_Datetimes {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_events', function ($t) {
			$t->drop_column(['start_time', 'end_time']);
		});

		Schema::table('core_events', function ($t) {
			$t->date('date');
			$t->timestamp('start_time');
			$t->timestamp('end_time');
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
			$t->drop_column(['start_time', 'end_time', 'date']);
		});

		Schema::table('core_events', function ($t) {
			$t->integer('start_time');
			$t->integer('end_time');
		});
	}

}