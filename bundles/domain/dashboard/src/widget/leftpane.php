<?php

namespace Dashboard\Widget;

use Repository;
use URI, Auth, View, Input;

class LeftPane
{
	protected $data = [
		'active_tagable' => null,
		'role' => null,
		'selected_tags' => [],
		'displayed_tags' => []
	];
	
	protected $view ='dashboard::common.left-pane';
	protected $uri;
	protected $user;

	public function __construct($uri = null, $user = null, $params = [])
	{
		$this->uri = $uri ? : URI::current();
		$this->user = $user ? : Auth::user();
		$this->params = $params ? : Input::get();

		$this->set_active_tagable();
		$this->set_role();
		$this->set_selected_tags();
		$this->set_displayed_tags();
	}

	protected function set_active_tagable()
	{
		if( ends_with($this->uri, 'listing') and starts_with($this->uri, 'dashboard') )
		{
			$parts = explode('/', $this->uri);
			$this->data['active_tagable'] = $parts[1];
			return;
		}
	}

	protected function set_role()
	{
		$this->data['role'] = 'fan';
	}

	protected function repo($slug)
	{
		return Repository::of($slug);
	}

	protected function set_selected_tags()
	{
		if(! $tag_slugs = @$this->params['tags'] )
			return;
	}

	protected function set_displayed_tags($current_tags = [])
	{
		$this->data['displayed_tags'] = $this->repo('tags')->find_for_tagable($this->data['active_tagable']);
	}

	public function render()
	{
		return View::make($this->view)->with($this->data)->render();
	}

	public function __tostring()
	{
		return $this->render();
	}
}