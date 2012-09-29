<?php

class SongUploader
{
	protected static function temp_dir()
	{
		return path('storage').'temp'.DS;
	}

	protected static $prefix = 'muselize-';

	public static function upload_song($pre_existing_song = null)
	{
		if( !Input::file('song_src') or Input::file('song_src.size') === 0)
		{
			if($pre_existing_song === null)
			{
				throw new ValidationException(array('song_src'=>array('No Song Uploaded')));
			}

			return $pre_existing_song;
		}

		$ext = File::extension(Input::file('song_src.name'));

		$val = Validator::make(array('extension' => $ext), array('extension' => 'in:wav,mp3,ogg'));

		if($val->fails())
		{
			throw new ValidationException($val->errors->messages);
		}

		$fpath = static::temp_dir() . randomize(Input::file('song_src.name')) . '.' . $ext;
		Input::upload('song_src', $fpath);

		return Uploader::upload_to(static::$prefix.'songs', $fpath);
	}

	public static function mime($pre_existing_mime = null)
	{
		if( !Input::file('song_src') or Input::file('song_src.size') === 0)
		{
			return $pre_existing_mime;
		}

		$ext = File::extension(Input::file('song_src.name'));
		return File::mime($ext);
	}
}