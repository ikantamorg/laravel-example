<?php

class TestAuth extends PHPUnit_Framework_TestCase 
{
	/**
	 * Setup the test
	 */
	public function setup()
	{
		Bundle::start('hybrid');

		// mock roles
		Event::listen('hybrid.auth.roles', function ($user_id, $roles)
		{
			return array('admin', 'editor');
		});
	}

	/**
	 * Test Hybrid\Auth::roles() returning valid roles
	 * 
	 * @test
	 */
	public function testRole()
	{
		$expected = array('admin', 'editor');
		$output   = Hybrid\Auth::roles();

		$this->assertEquals($expected, $output);
	}
}