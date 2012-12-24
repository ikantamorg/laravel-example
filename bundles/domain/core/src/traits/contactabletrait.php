<?php

namespace Core\Traits;

trait ContactableTrait
{
	public function set_contact_emails($emails)
	{
		$this->set_attribute('contact_emails', json_encode((array) $emails));
	}

	public function get_contact_emails()
	{
		return json_decode($this->get_attribute('contact_emails'));
	}

	public function set_contact_numbers($numbers)
	{
		$this->set_attribute('contact_numbers', json_encode((array) $numbers));
	}

	public function get_contact_numbers()
	{
		return json_decode($this->get_attribute('contact_numbers'));
	}
}