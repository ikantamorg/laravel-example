<?php

class Dashboard_Songs_Listing_Controller extends Dashboard_Base_Controller
{
	public $layout = 'dashboard::layouts.page.narrow';

	public function get_index()
	{
		$listing = $this->repo('songs')->filter(Input::get())->paginate($this->per_page);
		$count = $this->repo('songs')->filter(Input::get())->count();

		if($this->appendage())
			$listing->appends($this->appendage());

		return $this->layout->nest('body', 'dashboard::listings.songs', [
					'songs' => $listing->results,
					'num_songs' => $count,
					'prev_link' => $listing->previous(null, true, ['class' => 'pull-left']),
					'next_link' => $listing->next(null, true, ['class' => 'pull-right']),
				]);
	}
}