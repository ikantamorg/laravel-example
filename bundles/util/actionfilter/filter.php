<?php namespace ActionFilter;

class ActionNotSetException extends \Exception {}

class Filter
{
	protected $callback = null;
	protected $action   = null;
	protected $scope    = null;
	protected $actions  = null;

	public function __construct($callback)
	{
		$this->callback = $callback;
	}

	public static function make($callback)
	{
		return new static($callback);
	}

	public function scope($scope, $actions)
	{
		if ($actions and in_array($scope, ['only','except']))
		{
			$this->scope = $scope;
			$this->actions = (array) $actions;
		}
		return $this;
	}

	public function only($actions = [])
	{
		return $this->scope('only', $actions);
	}
	
	public function except($actions = [])
	{
		return $this->scope('except', $actions);
	}

	public function scoped()
	{
		return $this->scope or $this->actions;
	}

	public function relevant($action = null)
	{
		if ( ! $this->scoped())
		{
			return true;
		}
		else
		{
			if ($action = $this->action ?: $action)
			{
				if ($this->scope === 'only' and in_array($action, $this->actions))
				{
					return true;
				}

				if ($this->scope === 'except' and ! in_array($action, $this->actions))
				{
					return true;
				}

				return false;
			}
			else
			{
				throw new ActionNotSetException('No action was given to determine scope');
			}
		}
	}

	public function __call($name, $args)
	{
		if (isset($this->$name))
		{
			return $this->$name;
		}
	}
}
