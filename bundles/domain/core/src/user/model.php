<?php

namespace Core\User;

use Core\Abstracts;
use Hash;
use DB, Str;

class Model extends Abstracts\Model
{
	public static $table = 'core_users';

	public static $accessible = [];

	protected $_repeated_password = null;

	protected $_favorite_ids = [
		'songs' => null,
		'events' => null,
		'artists' => null,
		'videos' => null
	];

	public function is_admin()
	{
		$user_roles = array_map(function ($r) { return $r->name; }, $this->roles);
		return in_array('admin', $user_roles) or in_array('superadmin', $user_roles);
	}

	public function before_validation()
	{
		$this->set_validation([
			'password' => 'required|in:'.$this->repeated_password,
			'username' => 'required|max:200',
			'email'    => 'required|email|max:200|unique:'.$this->table()
		]);
	}

	public function before_save()
	{
		if( ! $this->exists or array_get($this->get_dirty(), 'password') )
			$this->attributes['password'] = Hash::make($this->attributes['password']);
	}

	public function before_delete()
	{
		$this->roles()->sync([]);
	}

	/**Relations and Setters/Getters**/
	public function roles()
	{
		return $this->has_many_and_belongs_to('Core\\User\\Role', 'core_user_role', 'user_id', 'role_id');
	}

	public function set_repeated_password($val)
	{
		$this->_repeated_password = $val;
	}

	public function get_repeated_password()
	{
		return $this->_repeated_password;
	}

	public function favorite_artists()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Artist\\Model',
			'core_user_favorite_artists', 'user_id', 'artist_id'
		);
	}

	public function favorite_events()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Event\\Model',
			'core_user_favorite_events', 'user_id', 'event_id'
		);
	}

	public function favorite_songs()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Media\\Song',
			'core_user_favorite_songs', 'user_id', 'song_id'
		);
	}

	public function favorite_videos()
	{
		return $this->has_many_and_belongs_to(
			'Core\\Media\\Video',
			'core_user_favorite_videos', 'user_id', 'video_id'
		);
	}

	protected function fav_pivot($resource_type)
	{
		return DB::table('core_user_favorite_'.$resource_type)->where_user_id($this->id);
	}

	public function favorite_ids($resource_type)
	{
		if(! array_key_exists($resource_type, $this->_favorite_ids))
			return [];

		if(is_array($this->_favorite_ids[$resource_type]))
			return $this->_favorite_ids[$resource_type];

		$resource_id_col = Str::singular($resource_type).'_id';
		$rows = $this->fav_pivot($resource_type)->select($resource_id_col)->get();

		$fav_ids = array_map(function ($r) use ($resource_id_col) { return $r->$resource_id_col; }, $rows);

		return $this->_favorite_ids[$resource_type] = $fav_ids;
	}

	public function get_fav_songs_ids()
	{
		return $this->favorite_ids('songs');
	}

	public function get_fav_events_ids()
	{
		return $this->favorite_ids('events');
	}

	public function get_fav_videos_ids()
	{
		return $this->favorite_ids('videos');
	}

	public function get_fav_artists_ids()
	{
		return $this->favorite_ids('artists');
	}

	public function in_favorited($resource_type, $resource)
	{
		return in_array($resource->id, $this->favorite_ids($resource_type));
	}
}