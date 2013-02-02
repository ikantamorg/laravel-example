<?php

class Uploader_Zombieuploads_Task
{
	protected static $_watched_fields = [
		'resource' => [
			'core_photos',
		],
		'stream_url' => [
			'core_songs'
		]
	];

	protected function q($table)
	{
		return DB::table($table);
	}

	protected function get_existing_resources()
	{
		$resources = [];

		foreach(static::$_watched_fields as $f => $tables)
		{
			foreach($tables as $t)
			{
				$resources = array_merge($resources, array_map(function ($r) use($f) { return $r->$f; }, $this->q($t)->get($f)));
			}
		}

		return $resources;
	}

	protected function local_upload_dir()
	{
		return path('public').'uploads'.DS;
	}

	protected function find_local_zombies()
	{
		$resources = $this->get_existing_resources();

		$dh = opendir($this->local_upload_dir());

		$zombies = [];

		while($file = readdir($dh))
		{
			if($file === '.' or $file === '..')
				continue;

			$is_zombie = true;

			foreach($resources as $r)
			{
				if( strpos($file, $r) !== false)
				{
					$is_zombie = false;
					break;
				}
			}

			if($is_zombie)
				$zombies[] = $file;
		}
		closedir($dh);
		
		return $zombies;
	}

	public function clear_local()
	{
		if( ! $zombies = $this->find_local_zombies() )
			echo 'No zombies to delete locally'."\n";
		foreach($zombies as $z)
		{
			$fpath = $this->local_upload_dir() . $z;
			echo 'deleting zombie : ' . $fpath . "\n";
			unlink($fpath);
		}
	}

	public function clear_s3()
	{

	}
}