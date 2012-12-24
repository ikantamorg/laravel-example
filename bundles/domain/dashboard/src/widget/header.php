<?php

namespace Dashboard\Widget;

class Header extends Base
{
	protected $view = 'dashboard::common.header';

	protected $data = [
		'role' => 'fan'
	];

	protected function setup()
	{
		
	}
}