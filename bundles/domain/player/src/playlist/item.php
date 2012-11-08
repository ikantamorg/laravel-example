<?php

namespace Playlist;

class Item
{
	protected $data = [];

	public function __construct($type, $model)
	{
		$this->data['type'] = $type;
		$this->data['model'] = $model;
	}

	public function to_array()
	{
		$data = $this->data;
		$data['model'] = $model->to_array();

		return $data;
	}
}