<?php

class Core_Make_Start_Time_End_Time_Datetime_Indices {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_events', function ($t) {
			$t->drop_column(['start_time', 'end_time', 'date']);
		});

		Schema::table('core_events', function ($t) {
			$t->date('start_time')->index();
			$t->date('end_time');
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
			$t->drop_column(['start_time', 'end_time']);
		});
		
		Schema::table('core_events', function ($t) {
			$t->string('date', 40);
			$t->string('start_time', 40);
			$t->string('end_time', 40);
		});
	}

}