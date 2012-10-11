<?php

class Dashboard_Videos_Listing_Controller extends Dashboard_Base_Controller
{
	public $layout = 'dashboard::layouts.page.narrow';

	public function get_index()
	{
		$q = $this->repo('videos')->filter(Input::get());
		$listing = $q->paginate();

		return $this->layout->nest('body', 'dashboard::listings.videos', [
					'videos' => $listing->results,
					'num_videos' => $q->count('id'),
					'prev_link' => $listing->previous(null, true, ['class' => 'pull-left']),
					'next_link' => $listing->previous(null, true, ['class' => 'pull-right'])
				]);
	}
}