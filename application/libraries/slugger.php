<?php

class Slugger
{
	protected $_model = null;
	protected $_title_field = 'name';
	protected $_slug_field = 'slug';

	protected static $_check = null;
	protected static $_step = null;

	public static function make($model, $title_field = null, $slug_field = null)
	{
		return with(new static($model, $title_field, $slug_field));
	}

	public function __construct($model, $title_field = null, $slug_field = null)
	{
		$this->_model = $model;
		$title_field !== null and $this->_title_field = $title_field;
		$slug_field !== null and $this->_slug_field = $slug_field;
	}

	public static function check()
	{
		if(static::$_check !== null)
			return static::$_check;

		return static::$_check = function ($self, $slug) {
			$match = $self->q()->where($self->slug_field(), '=', $slug)->first();
			return $match === null or (int) $match->id === (int) $self->model()->id;
		};
	}

	public static function step()
	{
		if(static::$_step !== null)
			return static::$_step;

		return static::$_step = function ($self, $suffix, $separator) {
			return Str::slug($self->model()->{$self->title_field()}.' '.$suffix, $separator);
		};
	}

	public function model($model = null)
	{
		if($model === null)
			return $this->_model;

		$this->_model = $model;
		return $this;
	}

	public function title_field($field = null)
	{
		if($field === null)
			return $this->_title_field;

		$this->_title_field = $field;
		return $this;
	}

	public function slug_field($field = null)
	{
		if($field === null)
			return $this->_slug_field;

		$this->_slug_field = $field;
		return $this;
	}

	public function q()
	{
		return DB::table($this->_model->table());
	}

	public function slugify($separator = '-', Closure $check = null, Closure $step = null)
	{
		$suffix = 1;
		$check = $check instanceof Closure ? $check : static::check();
		$step = $step instanceof Closure ? $step : static::step();
		
		$slug = $step($this, null, $separator);

		while(! $check($this, $slug) )
		{
			$slug = $step($this, $suffix, $separator);
			$suffix++;
		}

		$model = $this->model();

		$model->{$this->slug_field()} = $slug;

		return $this;
	}
}