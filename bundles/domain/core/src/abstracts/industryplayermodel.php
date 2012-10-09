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
		$register_entry = $this->registrar()->register_entry();
		return $register_entry;
	}

	/*********/
}