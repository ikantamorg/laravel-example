<?php

namespace Dashboard\Widget;

class RightPane extends Base
{
	protected $data = [
		'resource_type' => null,
		'featured' => []
	];

	protected $view = 'dashboard::common.right-pane';

	protected function setup()
	{
		$this->set_resource_type();
		$this->set_featured();
	}

	protected function set_resource_type()
	{
		if( ends_with($this->uri, 'listing') and starts_with($this->uri, 'dashboard') )
		{
			$parts = explode('/', $this->uri);
			$this->resource_type = $parts[1];
		}
	}

	protected function set_featured()
	{
		if(! $this->resource_type)
			return;

		$this->featured = $this->repo('featured')->find_all($this->resource_type);
	}
}