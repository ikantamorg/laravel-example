<?php

namespace Core\Geo;

use DB;
use Core\Abstracts;
use Core;

class City extends Abstracts\Model
{
	public static $table = 'core_cities';

	public static $acccessible = ['name'];

	public function before_delete()
	{
		DB::table(Core\Venue\Model::$table)->where_city_id($this->id)->update(['city_id' => 0]);
		DB::table(Core\Artist\Model::$table)->where_current_city_id($this->id)->update(['current_city_id' => 0]);
		DB::table(Core\Artist\Model::$table)->where_home_city_id($this->id)->update(['home_city_id' => 0]);
		DB::table(Core\IndustryMember\Profile::$table)->where_city_id($this->id)->update(['city_id' => 0]);
	}

	public function before_save()
	{
		$this->slugify();
	}

	/**Relations and Setters\Getters**/

	public function industry_member_profiles()
	{
		return $this->has_many('Core\\IndustryMember\\Profile', 'city_id');
	}

	public function country()
	{
		return $this->belongs_to('Core\\Geo\\Country', 'country_id');
	}

	public function residing_artists()
	{
		return $this->has_many('Core\\Artist\\Model', 'current_city_id');
	}

	public function originated_artists()
	{
		return $this->has_many('Core\\Artist\\Model', 'home_city_id');
	}

	public function venues()
	{
		return $this->has_many('Core\\Venue\\Model', 'city_id');
	}
}