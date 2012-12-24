<?php

class Test_ActionFilter extends PHPUnit_Framework_TestCase
{
	public function setup()
	{
		Bundle::start('actionfilter');
		$this->filter = new ActionFilter\Filter('test');
	}

	public function teardown()
	{
		unset($this->filter);
	}

	public function test_can_create_filter()
	{
		$this->assertNotNull($this->filter);
	}

	public function test_can_apply_scopes()
	{
		$this->filter->only('new');
		$this->assertTrue($this->filter->scoped());
	}

	public function test_can_determine_relevance_of_only()
	{
		$this->filter->only('new');
		$this->assertTrue($this->filter->relevant('new'));
		$this->assertFalse($this->filter->relevant('create'));
	}

	public function test_can_determine_relevance_of_except()
	{
		$this->filter->except('create');
		$this->assertTrue($this->filter->relevant('new'));
		$this->assertFalse($this->filter->relevant('create'));
	}
}
