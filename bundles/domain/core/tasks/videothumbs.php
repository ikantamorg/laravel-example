<?php

Bundle::start('core');
Bundle::start('youtube');

class Core_Videothumbs_Task
{
	protected $_videos = [];

	protected function get_videos()
	{
		if($this->_videos)
			return $this->_videos;

		return $this->_videos = Core\Media\Video::all();
	}

	protected function add_thumb_to_video($v)
	{
		$youtube_video = Youtube\Video::make($v->youtube_id);
		$v->thumb = $youtube_video->info()->data->thumbnail->hqDefault;
		$v->save();
	}


	public function make()
	{
		foreach($this->get_videos() as $v)
		{
			if(! $v->thumb or strlen($v->thumb) === 0)
				$this->add_thumb_to_video($v);
		}

		echo '!!! SUCESS !!!' . "\n\n";
	}
}