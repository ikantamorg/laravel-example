<?php

Bundle::start('core');

use Core\Tagable;

class Core_Tagables_Task
{
	protected function tag_name($slug)
	{
		$arr = explode('_', $slug);
		foreach($arr as $i => $a)
		{
			$arr[$i] = ucfirst($a);
		}

		return implode(' ', $arr);
	}

	protected function table_exists($table)
	{
		try
		{
			DB::table($table)->first();
			return true;
		}
		catch (Exception $e)
		{
			return false;
		}
	}

	protected function is_nameable($slug)
	{
		$regex = '/^[^_][a-z_]+[^_]$/i';

		return preg_match($regex, $slug) === 1;
	}

	protected function q()
	{
		return DB::table('core_tagables');
	}

	protected function pivot()
	{
		return DB::table('core_tagable_tag_type');
	}

	protected function clear_removed_tagables()
	{
		$slugs = array_keys(Config::get('core::tagables'));

		foreach($this->q()->get() as $r)
		{
			if( in_array($r->slug, $slugs) )
				continue;

			$this->pivot()->where_tagable_id($r->id)->delete();
			$this->q()->where_id($r->id)->delete();
		}
	}

	protected function check($slug, $class)
	{
		if(! $this->is_nameable($slug) )
			throw new Tagable\Exception('Cannot extract name from slug "'.$slug.'"');

		if(! class_exists($class) )
			throw new Tagable\Exception('Invalid slug "'.$slug.'" assosciated class "'.$class.'" does not exist');

		echo 'tagable "'.$slug.'" passed basic checking'."\n";
	}

	protected function insert_tagable($slug, $class)
	{
		if($this->q()->where_slug($slug)->first() !== null)
			return;
		
		$data = [
			'name' => $this->tag_name($slug),
			'slug' => $slug,
			'primary_tag_type_id' => 0,
			'active' => 1,
			'created_at' => new DateTime,
			'updated_at' => new DateTime
		];

		$this->q()->insert($data);

		echo 'tagable "'.$slug.'" inserted'."\n";
	}

	protected function create_content_map($slug, $class)
	{
		$table = 'core_tag_'.Str::singular($slug);

		if($this->table_exists($table))
			return;

		Schema::create($table, function ($t) use ($slug) {
			$t->increments('id');
			$t->integer('tag_id');
			$t->integer(Str::singular($slug).'_id');
			$t->timestamps();

			$t->unique(['tag_id', Str::singular($slug).'_id']);
		});

		echo 'tagable "'.$slug.'" content maps table created';
	}

	protected function create_tag_map($slug, $class)
	{
		$table = 'core_tag_map_'.Str::singular($slug);

		if($this->table_exists($table))
			return;
	}

	public function setup()
	{
		$this->clear_removed_tagables();

		foreach(Config::get('core::tagables') as $slug => $class)
		{
			$this->check($slug, $class);
			$this->insert_tagable($slug, $class);
			//$this->create_content_map($slug, $class);
			//$this->create_tag_map($slug, $class);
		}
	}
}