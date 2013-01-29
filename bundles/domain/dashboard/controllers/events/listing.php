<?php

class Dashboard_Events_Listing_Controller extends Dashboard_Base_Controller
{
	public $layout = 'dashboard::layouts.page.narrow';

	public function get_index()
	{
		$listing = $this->repo('events')->filter(Input::get())->paginate($this->per_page);
		$count = $listing->total;

		if($this->appendage())
			$listing->appends($this->appendage());
		
		$body = View::make('dashboard::listings.events', [
					'events' => $listing->results,
					'num_events' => $count,
					'prev_link' => $listing->previous(null, true, ['class' => 'pull-left']),
					'next_link' => $listing->next(null, true, ['class' => 'pull-right']),
				]);

		if(Request::ajax())
			return $body;
		else
			$this->layout->body = $body;
	}
}