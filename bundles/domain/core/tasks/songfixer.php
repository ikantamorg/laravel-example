<?php

Bundle::start('core');

class Core_Songfixer_Task
{
	protected $_muselize_songs = [];
	
	protected function muselize_songs()
	{
		if($this->_muselize_songs)
			return $this->_muselize_songs;

		return $this->_muselize_songs = Core\Media\Song::where('stream_url', 'like', '%muselize-songs%')->get();
	}

	protected function correct_stream_url($song)
	{
		$parts = explode('/', @$song->attributes['stream_url']);
		$resource = end($parts);

		$song->stream_url = $resource;

		$song->save();
	}

	public function run()
	{
		foreach($this->muselize_songs() as $s)
		{
			$this->correct_stream_url($s);
		}
	}
}