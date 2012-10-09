<?php

class Dashboard_Videos_Listing_Controller extends Dashboard_Base_Controller
{
	public $layout = 'dashboard::layouts.page.narrow';

	public function get_index()
	{
		$listing = $this->repo('videos')->get_listing();

		return $this->layout->nest('body', 'dashboard::listings.videos', [
					'videos' => $listing->results,
					'num_videos' => $this->repo('videos')->get_count(),
					'prev_link' => $listing->previous(null, true, ['class' => 'pull-left']),
					'next_link' => $listing->previous(null, true, ['class' => 'pull-right'])
				]);
	}
}