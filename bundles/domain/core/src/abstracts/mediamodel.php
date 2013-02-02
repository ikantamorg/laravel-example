<?php

namespace Core\Abstracts;

abstract class MediaModel extends TagableModel
{
	public function industry_register_entry()
	{
		$relation = $this->belongs_to('Core\\IndustryPlayer\\RegisterEntry', 'owner_id');
		return $relation;
	}
	
	public function get_owner()
	{
		if(! $register_entry = $this->industry_register_entry )
			return null;
		
		return $register_entry->industry_player;
	}
}