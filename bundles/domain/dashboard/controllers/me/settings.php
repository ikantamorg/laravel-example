<?php

class Dashboard_Me_Settings_Controller extends Dashboard_Base_Controller
{
	public $layout = 'dashboard::layouts.page.wideview';

	public function get_index()
	{
		$body = View::make('dashboard::me.settings.index');

		if(Request::ajax())
			return $body;
		else
			$this->layout->body = $body;			
	}
}