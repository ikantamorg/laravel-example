<?php

class ThumbMaker
{
	protected static $default = 'http://s3.amazonaws.com/muselize-test/music.png';

	protected static function temp_dir()
	{
		return path('storage').'temp'.DS;
	}

	protected static $prefix = 'muselize-';

	public static function thumb($pre_existing_thumb = null)
	{
		if( !Input::file('thumb') or Input::file('thumb.size') === 0)
		{
			if($pre_existing_thumb === null)
			{
				return static::$default;
			}

			return $pre_existing_thumb;
		}

		$val = Validator::make(Input::file(), array('thumb' => 'image'));

		if($val->fails())
		{
			throw new ValidationException($val->errors->messages);
		}

		$ext = File::extension(Input::file('thumb.name'));

		$name = randomize(Input::file('thumb.name')) .'.' . $ext;
		$fpath = static::temp_dir() . $name;
		Input::upload('thumb', static::temp_dir(), $name);

		Resizer::open($fpath)->resize(300, 300, 'crop')->save($fpath, 80);

		return Uploader::upload_to(static::$prefix.'thumbs', $fpath);
	}
}