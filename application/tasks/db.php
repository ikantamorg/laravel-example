<?php

Bundle::start('core');
Bundle::start('uploader');

use Core\Media\Song;

class Db_Task
{
	public function fix_song_times()
	{
		$songs = Song::all();

		foreach($songs as $i => $s) {
			$s->duration = $this->get_song_duration($s);
			$s->save();
			echo $i+1 . 'done' . "\n";
		}
	}

	protected function make_curl($url) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

	protected function temp_file()
	{
		return path('storage') . '/temp/dummy.mp3';
	}

	protected function get_song_duration($song)
	{
		file_put_contents($this->temp_file(), $this->make_curl($song->stream_url));
		$metadata = (new mp3file($this->temp_file()))->get_metadata();
		unlink($this->temp_file());
		return @$metadata['Length'];
	}
}