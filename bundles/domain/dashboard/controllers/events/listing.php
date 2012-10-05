<?php

class Dashboard_Events_Listing_Controller extends Dashboard_Base_Controller
{
	public $layout = 'dashboard::layouts.page.narrow';

	public function get_index()
	{
		$listing = $this->repo('events')->get_listing();

		return $this->layout->nest('body', 'dashboard::listings.events', [
					'events' => $listing->results,
					'num_events' => $this->repo('events')->count(),
					'prev_link' => $listing->previous(null, true, ['class' => 'pull-left']),
					'next_link' => $listing->next(null, true, ['class' => 'pull-right']),
					'venue_name_maker' => function ($venue) { return $venue->name . ', ' . $venue->city->name; }
				]);
	}
}