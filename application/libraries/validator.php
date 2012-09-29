<?php

class Validator extends Laravel\Validator
{
	protected function validate_unique_with($attribute, $value, $params)
	{
		$table = array_shift($params);

		$fields = $params;

		$q = DB::table($table)->where($attribute, '=', $value);

		foreach($fields as $f)
		{
			$q = $q->where($f, '=', array_get($this->attributes, $f));
		}

		return $q->first() === null;
	}

	protected function validate_equals($attribute, $value, $params)
	{
		return $value === array_get($params, 0);
	}

	protected function validate_valid_timestamp($attribute, $value, $params)
	{
		$regex = '/^\d+$/';
		return preg_match($regex, (string) $value) !== 0;
	}

	protected function validate_many_exist($attribute, $value, $params)
	{
		$value = (array) $value;
		$table = array_shift($params);
		$field = array_shift($params) ? : 'id';
		$exact = array_shift($params) === 'exact';

		if(! $value )
		{
			return false;
		}

		$rows = DB::table($table)->where_in($field, $value)->get();

		return $exact ? count($rows) === count($value) : (boolean) $rows;
	}

	protected function validate_greater_than($attribute, $value, $params)
	{
		$value = (int) $value;
		$field = array_shift($params);
		$strict = array_shift($params) === 'strict';
		
		$attr_val = preg_match('/^\d+$/', $field) === 1 ? (int) $field : (int) array_get($this->attributes[$field]);

		return $strict ? $value > $attr_val : $value >= $attr_val;
	}

	protected function validate_less_than($attribute, $value, $params)
	{
		$value = (int) $value;
		$field = array_shift($params);
		$strict = array_shift($params) === 'strict';
		
		$attr_val = preg_match('/^\d+$/', $field) === 1 ? (int) $field : (int) array_get($this->attributes[$field]);

		return $strict ? $value < $attr_val : $value <= $attr_val;	
	}

	protected function validate_all_in($attribute, $value, $params)
	{
		$value = (array) $value;

		return (boolean) array_diff($value, $params) === false;
	}
}