<?php

abstract class ActiveEloquent extends Eloquent
{
	public $errors                    = array();
	protected  $custom_rules          = array(); // Override for instance
	protected  $custom_messages       = array(); // Override for instance

	public static $rules              = array();
	public static $messages           = array();
	public static $attr_accessor      = array();
	protected static $valid_callbacks = array(
		'before_validation',
		'after_validation',
		'before_save',
		'after_save',
		'before_create',
		'after_create',
		'before_update',
		'after_update',
		'before_delete',
		'after_delete',
	);

	public function __construct($attributes = array(), $exists = false)
	{
		$this->errors = new \Messages();
		parent::__construct($attributes, $exists);
	}

	public function attr_accessors()
	{
		$accessors = array();
		foreach (static::$attr_accessor as $a)
		{
			$accessors[$a] = isset($this->$a) ? $this->$a : null;
		}

		return $accessors;
	}

	public function set_validation($rules = array(), $messages = array())
	{
		$this->custom_rules = $rules;
		$this->custom_messages = $messages;

		return $this;
	}

	public function is_valid($exceptions = false)
	{
		$valid = true;
		$data = array();
		
		$this->invoke_callback('before_validation');

		$rules = $this->custom_rules ?: static::$rules;
		$messages = $this->custom_messages ?: static::$messages;

		if ($rules)
		{
			if ($this->exists)
			{
				$data = array_merge($this->get_dirty(), $this->attr_accessors());
				$rules = array_intersect_key($rules, $data);
			}
			else
			{
				$data = array_merge($this->attributes, $this->attr_accessors());
			}

			$validator = Validator::make($data, $rules, $messages);

			if ($valid = $validator->valid())
			{
				$this->errors->messages = array();
			}
			else
			{
				$this->errors = $validator->errors;
				if ($exceptions)
				{
					throw new ValidationException($this->errors->messages);
				}
			}
		}
		
		$this->invoke_callback('after_validation');

		return $valid;
	}

	// Alias
	public function is_valid_or_ex()
	{
		return $this->is_valid(true);
	}

	public function force_save()
	{
		$this->save(true);
	}

	
	public function save($force_save = false, $exceptions = false)
	{
		// Commenting out for now //if ( ! $this->dirty()) return true;

		if (static::$timestamps)
		{
			$this->timestamp();
		}

		if ($force_save or $this->is_valid($exceptions))
		{
			$this->invoke_callback('before_save');

			// If the model exists, we only need to update it in the database, and the update
			// will be considered successful if there is one affected row returned from the
			// fluent query instance. We'll set the where condition automatically.
			if ($this->exists)
			{
				$this->invoke_callback('before_update');

				$query = $this->query()->where(static::$key, '=', $this->get_key());

				$result = $query->update($this->get_dirty()) === 1;

				$this->invoke_callback('after_update');
			}

			// If the model does not exist, we will insert the record and retrieve the last
			// insert ID that is associated with the model. If the ID returned is numeric
			// then we can consider the insert successful.
			else
			{
				$this->invoke_callback('before_insert');

				$id = $this->query()->insert_get_id($this->attributes, $this->sequence());

				$this->set_key($id);

				$this->exists = $result = is_numeric($this->get_key());

				$this->invoke_callback('after_insert');
			}

			$this->invoke_callback('after_save');

			// After the model has been "saved", we will set the original attributes to
			// match the current attributes so the model will not be viewed as being
			// dirty and subsequent calls won't hit the database.
			$this->original = $this->attributes;

			return $result;
		}
		else
		{
			return false;
		}
	}

	// Alias
	public function save_or_ex($force_save = false)
	{
		return $this->save($force_save, true);
	}

	public function delete()
	{
		$this->invoke_callback('before_delete');

		$return = parent::delete();

		$this->invoke_callback('after_delete');

		return $return;
	}
	
	protected function invoke_callback($name)
	{
		if (method_exists($this, $name))
		{
			$this->$name();
		}
	}
}
