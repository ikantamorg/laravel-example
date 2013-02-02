<?php

namespace Repository;

use Auth, DB, Str;

class User
{
	protected $user = null;

	protected $allowed_resource_types = [
		'events', 'songs', 'artists', 'videos'
	];

	public function __construct($user = null)
	{
		$this->user = $user ? : Auth::user();
	}

	protected function pivot($resource_type)
	{
		return DB::table('core_user_favorite_'.$resource_type);
	}

	public function count_fav($resource_type)
	{
		return $this->pivot($resource_type)->where_user_id(@$this->user->id)->count('id');
	}

	public function add_to_favorites($resource_type, $resource)
	{
		if(! $this->user or ! in_array($resource_type, $this->allowed_resource_types) )
			return;

		$resource_id_col = Str::singular($resource_type).'_id';

		$rows = $this->pivot($resource_type)->where_user_id($this->user->id)->select($resource_id_col)->get();
		$fav_resources_ids = array_map(function ($r) use ($resource_id_col) { return $r->$resource_id_col; }, $rows);

		if(in_array($resource->id, $fav_resources_ids))
			return;

		$this->user->{'favorite_'.$resource_type}()->attach($resource);
	}

	public function remove_from_favorites($resource_type, $resource)
	{
		if(! $this->user or ! in_array($resource_type, $this->allowed_resource_types))
			return;

		$resource_id_col = Str::singular($resource_type).'_id';

		$rows = $this->pivot($resource_type)->where_user_id($this->user->id)->select($resource_id_col)->get();
		$fav_resources_ids = array_map(function ($r) use ($resource_id_col) { return $r->$resource_id_col; }, $rows);

		if( ! in_array($resource->id, $fav_resources_ids))
			return;

		$this->user->{'favorite_'.$resource_type}()->detach($resource);
	}
}