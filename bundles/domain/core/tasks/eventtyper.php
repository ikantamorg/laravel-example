<?php

class Core_Eventtyper_Task
{
	protected $event_types = [];

	protected function q($table)
	{
		return DB::connection()->table($table);
	}

	protected function get_unique_types()
	{
		foreach($this->q('core_events')->get() as $e) {
			if( in_array($e->type, $this->event_types) )
				continue;

			$this->event_types[] = $e->type;
		}
	}

	protected function commit_unique_event_types()
	{
		foreach($this->event_types as $i => $et) {
			if($this->q('core_event_types')->where_name($et)->first())
				continue;

			$this->q('core_event_types')->insert([
				'name' => $et
			]);
		}
	}

	protected function make_connections()
	{
		foreach($this->event_types as $et) {
			$type = $this->q('core_event_types')->where_name($et)->first();
			$this->q('core_events')->where_type($et)->update(['type_id' => $type->id]);
		}
	}

	public function run()
	{
		$this->get_unique_types();
		$this->commit_unique_event_types();
		$this->make_connections();
	}
}