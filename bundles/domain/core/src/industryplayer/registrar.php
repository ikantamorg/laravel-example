<?php

namespace Core\IndustryPlayer;

use Exception;

class IllegalRegisterEntryOperation extends Exception { }

class Registrar
{
	protected $_industry_player = null;
	protected $_data = [];
	protected $_register_entry = null;

	public function for_industry_player($industry_player)
	{
		$this->_register_entry = null;
		$this->_data = [];
		$this->_industry_player = $industry_player;
		return $this;
	}

	public function data()
	{
		if(! $this->_industry_player )
			return [];

		if($this->_data)
			return $this->_data;

		return $this->_data = [
			'name' => $this->_industry_player->name,
			'industry_player_id' => $this->_industry_player->id,
			'type' => $this->_industry_player->register_entry_type,
			'profile_photo_id' => $this->_industry_player->profile_photo_id
		];
	}

	public function register_entry()
	{
		if(! $this->_industry_player )
			return null;

		$this->_register_entry = RegisterEntry::with([
													'industry_memberships',
													'industry_memberships.industry_member_profile',
													'industry_memberships.membership_tag_connections',
													'industry_memberships.membership_tag_connections.membership_tag',
													'industry_memberships.membership_tag_connections.connected_industry_player'
												])->where('industry_player_id', '=', $this->_industry_player->id)
												  ->where('type', '=', $this->_industry_player->register_entry_type)
											      ->first();
		return $this->_register_entry;
	}

	public function make_entry()
	{
		if($this->register_entry() or ! $this->_industry_player )
			throw new IllegalRegisterEntryOperation('make entry');

		with($register_entry = new RegisterEntry)->fill_raw($this->data());
		$register_entry->save();
		$this->_register_entry = $register_entry;

		return $this;
	}

	public function update_entry()
	{
		if(! $this->register_entry() or ! $this->_industry_player )
			throw new IllegalRegisterEntryOperation('update entry');

		$this->register_entry()->fill_raw($this->data())->save();

		return $this;
	}

	public function remove_entry()
	{
		if( ! $this->register_entry() )
			throw new IllegalRegisterEntryOperation('remove entry');

		$this->_register_entry->delete();

		return $this;
	}
}