<?php

class Dashboard_Videos_Listing_Controller extends Dashboard_Base_Controller
{
	public $layout = 'dashboard::layouts.page.narrow';

	public $per_page = 21;

	public function get_index()
	{
		$listing = $this->repo('videos')->filter(Input::get())->paginate($this->per_page);
		$count = $this->repo('videos')->filter(Input::get())->count();

		if($this->appendage())
			$listing->appends($this->appendage());

		return $this->layout->nest('body', 'dashboard::listings.videos', [
					'videos' => $listing->results,
					'num_videos' => $count,
					'prev_link' => $listing->previous(null, true, ['class' => 'pull-left']),
					'next_link' => $listing->next(null, true, ['class' => 'pull-right'])
				]);
	}
}