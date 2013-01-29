<?php

class Dashboard_Home_Controller extends Dashboard_Base_Controller
{
	public $layout = 'dashboard::layouts.page.wideview';

	public function get_index()
	{
		return $this->layout->nest('body', 'dashboard::home.index');
	}
}