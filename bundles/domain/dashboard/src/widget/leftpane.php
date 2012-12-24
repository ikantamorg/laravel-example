<?php

namespace Dashboard\Widget;


class LeftPane extends Base
{
	protected $data = [
		'active_tagable' => null,
		'role' => null,
		'selected_tags' => [],
		'displayed_tags' => [],
		'qs' => null
	];
	
	protected $view ='dashboard::common.left-pane';
	
	protected function setup()
	{
		$this->set_active_tagable();
		$this->set_role();
		$this->set_selected_tags();
		$this->set_displayed_tags();
		$this->set_query_string_builder();
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

	protected function set_query_string_builder()
	{
		$this->qs = function ($slug, $key = null) { return $this->query_string($slug, $key); };
	}

	protected function query_string($slug, $key = null)
	{
		if($this->active_tagable->slug === 'events') {
			return http_build_query([$key => $slug] + $this->params);
		}

		$params = $this->params;
		unset($params['page']);
		$params['tags'] = @$params['tags'] ? : [];

		$params_count = count($this->params) - 1 + count((array) $params['tags']);

		if($params_count < 3) {
			$params['tags'][] = $slug;
		} else {
			$params[count($params)-1] = $slug;
		}

		return http_build_query($params);
	}
}