<?php

class Core_Slugger_Task
{
	protected $tables = [
		//'core_artists',
		//'core_tags',
		//'core_companies',
		//'core_events',
		//'core_cities',
		//'core_industry_members',
		//'core_songs',
		//'core_videos',
		//'core_venues'
	];


	protected function check_model_needs_slugging($class) {
		if( ! $row = $class::first() )
			return false;
		return $row->slug === null ? true : false;
	}

	protected function model($table) {
		return new DummyModel($table);
	}

	protected function slugify_model($table)
	{
		$model = $this->model($table);

		$venue_check = function ($self, $slug) {
			return $self->q()->where_city_id($self->model()->city_id)->where_slug($slug)->first() === null;
		};

		$i = 0;
		foreach($this->q($table)->get() as $r)
		{
			$model->set_attributes((array) $r);

			if($table === 'core_venues') {
				Slugger::make($model)->slugify('-', $venue_check);
			} else {
				Slugger::make($model)->slugify();
			}

			DB::table($table)->where_id($model->id)->update(['slug' => $model->slug]);
		}
	}

	protected function q($table)
	{
		return DB::table($table);
	}

	public function run()
	{
		$i = 0;
		foreach($this->tables as $t) {
			//if( $this->check_model_needs_slugging($class) )
				//continue;
			$this->slugify_model($t);
		}
	}
}

class DummyModel
{
	protected $attributes = [];
	protected $_table = null;

	public function __construct($table)
	{
		$this->_table = $table;
	}

	public function __get($prop)
	{
		return @$this->attributes[$prop];
	}

	public function __set($prop, $val)
	{
		$this->attributes[$prop] = $val;
	}

	public function set_attributes($attrs)
	{
		$this->attributes = $attrs;
	}

	public function table()
	{
		return $this->_table;
	}
}
