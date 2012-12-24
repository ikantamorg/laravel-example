<?php

class Slugger_Test extends PHPUnit_Framework_Testcase
{
	public function setup()
	{
		$this->model = MockModel::first();
		$this->slugger = Slugger::make($this->model);
	}

	public function teardown()
	{
		$this->model = null;
		$this->slugger = null;
	}

	public function test_is_string_slug()
	{
		$this->slugger->slugify();
		$this->assertTrue(is_string($this->model->slug));
	}

	public function test_slug_is_unique()
	{
		$this->slugger->slugify();

		$match = MockModel::where_slug($this->model->slug)->first();

		$this->assertTrue($match === null or (int) $match->id === (int) $this->model->id);
	}

	public function test_can_use_custom_separator()
	{
		$this->slugger->slugify('$');
		$this->assertTrue(strpos($this->model->slug, '$') !== false);
	}

	public function test_can_use_custom_step()
	{
		$check = null;
		$step = function ($self, $suffix, $separator) {
			return Str::slug($self->model()->{$self->title_field()}.' '.StarStub::stars($suffix), $separator);
		};
		$this->slugger->slugify('-', $check, $step);

		$this->assertTrue(strpos($this->model->slug, strtolower('xXxXxX')) !== false);
	}

	public function test_can_use_custom_check()
	{
		$step = null;
		$check = function ($self, $slug) {
			$match = $self->q()->where($self->slug_field(), '=', $slug)->first();
			return $match === null;
		};

		$this->slugger->slugify('-', $check);

		$this->assertTrue(ends_with($this->model->slug, '-1'));
	}
}

class MockModel extends Eloquent
{
	public static $table = 'core_events';
}

class StarStub
{
	public function stars($n)
	{
		$str = '';

		foreach(range(0, (int) $n) as $i)
		{
			$str .= 'xXxXxX';
		}

		return $str;
	}
}