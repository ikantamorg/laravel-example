<?php


class ValidationException extends Exception
{
	protected $errors;

	public function __construct(array $errors = array(), $code = 0)
	{
		parent::__construct(HTML::ul($errors, array('class'=>'unstyled')), $code);
		
		$this->errors = $errors;
	}

	public function getErrors()
	{
		return $this->errors;
	}

}
