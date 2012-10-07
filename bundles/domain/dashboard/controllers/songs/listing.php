<?php

class Dashboard_Songs_Listing_Controller extends Dashboard_Base_Controller
{
	public $layout = 'dashboard::layouts.page.narrow';

	public function get_index()
	{
		$listing = $this->repo('songs')->get_listing();

		return $this->layout->nest('body', 'dashboard::listings.songs', [
					'songs' => $listing->results,
					'num_songs' => $this->repo('songs')->get_count(),
					'prev_link' => $listing->previous(null, true, ['class' => 'pull-left']),
					'next_link' => $listing->next(null, true, ['class' => 'pull-right']),
				]);
	}
}