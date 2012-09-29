<?php

class Date
{
	public static function to_timestamp($date = null, $format = null)
	{
		if($format === null)
		{
			$format = 'input';
		}

		return date_timestamp_get(date_create_from_format(Config::get("date.{$format}_format"), $date));
	}

	public static function from_timestamp($date = null, $format = null)
	{
		if($format === null)
		{
			$format = 'output';
		}

		return date(Config::get("date.{$format}_format"), $date);
	}
}