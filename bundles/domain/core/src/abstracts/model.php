<?php

namespace Core\Abstracts;

use ActiveEloquent;
use Slugger;
use Closure;

abstract class Model extends ActiveEloquent
{
	public function activate()
	{
		$this->active = true;
		return $this->save();
	}

	public function deactivate()
	{
		$this->active = false;
		return $this->save();
	}

	public function creator()
	{
		return $this->belongs_to('Core\\User\\Model', 'creator_id');
	}

	protected function url_params($attrs = [])
	{
		$url_params = null;
		foreach($attrs as $k=>$v)
			$url_params .= $url_params === null ? "?{$k}=".urlencode($v) : "&{$k}=".urlencode($v);

		return $url_params;
	}

	protected function slugify($separator = '-', Closure $check = null, Closure $step = null)
	{
		Slugger::make($this)->slugify($separator, $check, $step);
	}
}