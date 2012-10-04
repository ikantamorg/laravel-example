<?php

class Dashboard_Artists_Listing extends Dashboard_Base_Controller
{
	public $layout = 'dashboard::layouts.page.narrow';

	public function get_index()
	{
		$artists = Repsitory\Artist::get_listing();
	}
}