<?php

class Dashboard_Artists_Listing_Controller extends Dashboard_Base_Controller
{
	public $layout = 'dashboard::layouts.page.narrow';

	public function get_index()
	{
		$listing = Repository\Artist::get_listing();

		return $this->layout->nest('body', 'dashboard::listings.artists', ['listing' => $listing]);
	}
}