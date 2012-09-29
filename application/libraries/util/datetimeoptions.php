<?php

namespace Util;

class DateTimeOptions
{
	protected static $_times = [];

	public static function times()
	{
		if(static::$_times)
			return static::$_times;
		
		$hours = array_merge([12], range(1, 11));
		$flag = ['AM', 'PM'];
		$minutes = range(0, 59);

		$times = [];
		foreach($flag as $f) {

			foreach($hours as $h) {

				foreach($minutes as $m) {
					if($m%5 === 0) {
						$m = $m < 10 ? '0'.$m : $m;
						$times[] = $h.':'.$m.' '.$f;
					}
				}
			}
		}
		return static::$_times = $times;
	}
}