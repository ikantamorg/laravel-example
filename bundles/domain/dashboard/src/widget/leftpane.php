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
	protected $params;

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

	public function __get($prop)
	{
		return @$this->data[$prop];
	}

	public function __set($prop, $val)
	{
		if(array_key_exists($prop, $this->data))
			$this->data[$prop] = $val;
	}

	protected function repo($slug)
	{
		return Repository::of($slug);
	}

	protected function set_active_tagable()
	{
		if( ends_with($this->uri, 'listing') and starts_with($this->uri, 'dashboard') )
		{
			$parts = explode('/', $this->uri);
			$tagable_slug = $parts[1];
			
			$this->active_tagable = $this->repo('tagables')->find_by_slug($tagable_slug);
			return;
		}
	}

	protected function set_role()
	{
		$this->role = 'fan';
	}

	protected function set_selected_tags()
	{
		if(! $tag_slugs = @$this->params['tags'] )
			return;

		$selected_tags = [];
		foreach($tag_slugs as $slug) { 
			$selected_tags[] = $this->repo('tags')->filter(['tagable' => $this->active_tagable])->find_by_slug($slug); 
		}

		$this->selected_tags = $selected_tags;
	}

	protected function set_displayed_tags()
	{
		$params = [
			'tagable' => $this->active_tagable,
			'selected_tags' => array_slice($this->selected_tags, 0, 2)
		];

		$this->displayed_tags = $this->repo('tags')->filter($params)->find_all();
	}

	protected function query_string($slug, $key = null)
	{
		if($this->active_tagable->slug === 'events') {
			return http_build_query([$key => $slug] + $this->params);
		}

		$params = $this->params;
		$params['tags'] = @$params['tags'] ? : [];
		$params['tags'][] = $slug;

		return http_build_query($params);
	}

	public function render()
	{
		return View::make($this->view)
					->with($this->data)
					->with('params', $this->params)
					->with('user', $this->user)
					->with('qs', function ($slug, $key = null) { return $this->query_string($slug, $key); })
					->render();
	}

	public function __tostring()
	{
		return $this->render();
	}
}