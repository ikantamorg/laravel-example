<?php

class HTML extends Laravel\HTML
{
	public static function ol($list, $attributes = array(), $raw = false)
	{
		return static::listing('ol', $list, $attributes, $raw);
	}

	/**
	 * Generate an un-ordered list of items.
	 *
	 * @param  array   $list
	 * @param  array   $attributes
	 * @return string
	 */
	public static function ul($list, $attributes = array(), $raw = false)
	{
		return static::listing('ul', $list, $attributes, $raw);
	}

	/**
	 * Generate an ordered or un-ordered list.
	 *
	 * @param  string  $type
	 * @param  array   $list
	 * @param  array   $attributes
	 * @return string
	 */
	private static function listing($type, $list, $attributes = array(), $raw = false)
	{
		$html = '';

		foreach ($list as $key => $value)
		{
			// If the value is an array, we will recurse the function so that we can
			// produce a nested list within the list being built. Of course, nested
			// lists may exist within nested lists, etc.
			if (is_array($value))
			{
				$html .= static::listing($type, $value, $attributes, $raw);
			}
			else
			{
				if($raw === false)
					$html .= '<li>'.static::entities($value).'</li>';
				else
					$html .= '<li>'.$value.'</li>';
			}
		}

		return '<'.$type.static::attributes($attributes).'>'.$html.'</'.$type.'>';
	}
}