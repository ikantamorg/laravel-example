<?php

class Dashboard_Me_Settings_Controller extends Dashboard_Base_Controller
{
	public $layout = 'dashboard::layouts.page.wideview';

	public function get_index()
	{
		return $this->layout->nest('body', 'dashboard::me.settings.index');
	}
}