<?php

class Db_Task
{
	public function run()
	{
		$q = DB::table('core_events')->where('start_time', '>', new DateTime);

		var_dump($q->grammar->select($q), $q->bindings);
	}
}