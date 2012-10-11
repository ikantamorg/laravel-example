<?php

class Dashboard_Artists_Listing_Controller extends Dashboard_Base_Controller
{
	public $layout = 'dashboard::layouts.page.narrow';

	public function get_index()
	{
		$q = $this->repo('artists')->filter(Input::get());
		$listing = $q->paginate();

		return $this->layout->nest('body', 'dashboard::listings.artists', [
					'artists' => $listing->results,
					'num_artists' => $q->count(),
					'prev_link' => $listing->previous(null, true, ['class' => 'pull-left']),
					'next_link' => $listing->next(null, true, ['class' => 'pull-right'])
				]);
	}
}