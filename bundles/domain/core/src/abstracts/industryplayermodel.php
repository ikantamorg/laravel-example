<?php

namespace Core\Abstracts;

use Core\IndustryPlayer\Registrar;
use Core\IndustryPlayer\Map;

abstract class IndustryPlayerModel extends ContactableModel
{
	protected $_registrar = null;

	protected function registrar()
	{
		if($this->_registrar)
			return $this->_registrar;
		
		return $this->_registrar = (new Registrar)->for_industry_player($this);
	}

	/**Hooks**/

	public function after_insert()
	{
		$this->registrar()->make_entry();
	}

	public function after_update()
	{
		$this->registrar()->update_entry();
	}

	public function after_delete()
	{
		$this->registrar()->remove_entry();
	}

	public function get_register_entry_type()
	{
		$slug = Map::class_to_slug(get_called_class());
		return $slug;
	}

	/********/

	public function get_register_entry()
	{
		return $this->registrar()->register_entry();
	}

	public function get_industry_memberships($tag = null)
	{
		if(! $this->register_entry )
			return [];

		if($tag === null)
			return $this->register_entry->industry_memberships;

		return array_values(array_filter(
			$this->register_entry->industry_memberships,
				function ($m) use ($tag) {
					return in_array($tag, array_map(function ($t) { return $t->name; }, $m->membership_tags));
				}
			));
	}

	/*********/
}