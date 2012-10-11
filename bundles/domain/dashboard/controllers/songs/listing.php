<?php

class Dashboard_Songs_Listing_Controller extends Dashboard_Base_Controller
{
	public $layout = 'dashboard::layouts.page.narrow';

	public function get_index()
	{
		$q = $this->repo('songs')->filter(Input::get());
		$listing = $q->paginate();

		return $this->layout->nest('body', 'dashboard::listings.songs', [
					'songs' => $listing->results,
					'num_songs' => $q->count(),
					'prev_link' => $listing->previous(null, true, ['class' => 'pull-left']),
					'next_link' => $listing->next(null, true, ['class' => 'pull-right']),
				]);
	}
}