<?php

class Dashboard_Artists_Listing_Controller extends Dashboard_Base_Controller
{
	public $layout = 'dashboard::layouts.page.narrow';

	public function get_index()
	{
		$listing = $this->repo('artists')->filter(Input::get())->paginate($this->per_page);
		$count = $listing->total;

		if($this->appendage())
			$listing->appends($this->appendage());

		$body = View::make('dashboard::listings.artists', [
					'artists' => $listing->results,
					'num_artists' => $count,
					'prev_link' => $listing->previous(null, true, ['class' => 'pull-left']),
					'next_link' => $listing->next(null, true, ['class' => 'pull-right'])
				]);

		if(Request::ajax())
			return $body;
		else
			$this->layout->body = $body;
	}
}