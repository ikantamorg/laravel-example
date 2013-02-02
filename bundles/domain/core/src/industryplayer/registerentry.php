<?php

namespace Core\IndustryPlayer;

use Core\Abstracts;
use Core\Media;
use DateTime;
use DB;

class RegisterEntry extends Abstracts\Model
{
	public static $accessible = [];

	public static $table = 'core_industry_players_register';

	public function before_delete()
	{
		$tables = [Media\Photo::$table, Media\Song::$table, Media\Video::$table];
		foreach($tables as $t)
			DB::table($t)->where_owner_id($this->id)->update(['owner_id' => 0]);

		foreach($this->industry_memberships as $membership)
			$membership->delete();
	}

	/**Relations and Getters/Setters**/

	protected $_industry_player = null;

	public function get_industry_player()
	{
		if($this->_industry_player)
			return $this->_industry_player;
		
		if( ! $class = Map::slug_to_class($this->type) )
			return null;

		return $this->_industry_player = $class::find($this->industry_player_id);
	}

	public function industry_memberships()
	{
		return $this->has_many('Core\\IndustryMember\\Membership', 'industry_register_entry_id');
	}

	public function photos()
	{
		return $this->has_many('Core\\Media\\Photo', 'owner_id');
	}

	public function profile_photo()
	{
		return $this->belongs_to('Core\\Media\\Photo', 'profile_photo_id');
	}

	public function songs()
	{
		return $this->has_many('Core\\Media\\Song', 'owner_id');
	}

	public function videos()
	{
		return $this->has_many('Core\\Media\\Video', 'owner_id');
	}
}