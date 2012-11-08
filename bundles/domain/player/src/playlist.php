<?php

namespace Player;

use Session;

class Playlist
{
	const SESSION_KEY = 'playlist';

	protected static $_instance = null;

	protected $items = [];

	public static function instance()

	{
		if($this->_instance)
			return $this->_instance;
			
		return $this->_instance = Session::get(static::SESSION_KEY, new static());
	}

	public static function persist()
	{
		Session::put(static::SESSION_KEY, static::instance());
	}

	/**Protecting the constructor to implement the singleton**/

	protected function __construct()
	{
	}

	/**Public API**/

	public function items()
	{
		return $this->items;
	}

	public function add_item($type, $model)
	{
		if(! in_array($type, ['song', 'video']))
			return false;

		$this->items[] = new Playlist\Item($type, $model);
		static::persist();
		return count($this->items) - 1;
	}

	public function remove_item_at($index)
	{
		if(! isset($this->items[$index]))
			return false;

		unset($this->items[$index]);
		$this->items = array_values($this->items);
		static::persist();
		return true;
	}

	public function get_item_at($index)
	{
		return @$this->items[$index];
	}

	public function to_array()
	{
		$data = [];

		foreach($this->items as $item)
			$data[] = $item->to_array();

		return $data;
	}
}