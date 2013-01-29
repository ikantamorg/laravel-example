<?php

if(! class_exists('Core_Eventtyper_Task') )
	require Bundle::path('core').'tasks/'.'eventtyper.php';

class Core_Add_Type_Id_To_Events {

	protected $_task = null;

	protected function task()
	{
		if($this->_task)
			return $this->_task;

		return $this->_task = new Core_Eventtyper_Task;
	}

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('core_events', function ($t) {
			$t->integer('type_id')->nullable()->index();
		});

		$this->task()->run();

		Schema::table('core_events', function ($t) {
			$t->drop_column('type');
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
			$t->drop_column('type_id');
		});

		Schema::table('core_events', function ($t) {
			$t->string('type');
		});
	}

}