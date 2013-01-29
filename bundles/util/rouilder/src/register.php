<?php

namespace Rouilder;

use Bundle, Route, Str;

class Register
{
	protected $_bundle = DEFAULT_BUNDLE;
	protected $_bundle_prefix = null;
	protected $_handled_resources = array();
	
	public function bundle($bundle = null)
	{
		if($bundle === null)
			return $this->_bundle;

		$this->_bundle = $bundle;

		return $this;
	}

	protected function bundle_pre()
	{
		if($this->_bundle_prefix !== null)
			return $this->_bundle_prefix;

		if($this->_bundle === DEFAULT_BUNDLE)
			return $this->_bundle_prefix = '';
		else
			return $this->_bundle_prefix = Bundle::option($this->_bundle, 'handles', $this->_bundle);
	}

	protected function bundle_uri_pre()
	{
		return $this->bundle_pre() . '/';
	}

	protected function bundle_name_pre()
	{
		return $this->bundle_pre() === '' ? '' : $this->bundle_pre().'_';
	}

	protected function bundle_controller_pre()
	{
		return $this->bundle_pre() === '' ? '' : $this->bundle_pre().'::';
	}

	protected function route_resource($resource, $verbs)
	{
		$parts = explode('.', $resource);

		foreach(array(null, 'show', 'new', 'edit') as $action)
		{
			Route::get($this->uri_str($parts, $action), array(
				'as' => $this->name_str($parts, $action), 'uses' => $this->uses_str($parts, $action)
			));
		}

		Route::post($this->uri_str($parts, 'create'), array(
			'as' => $this->name_str($parts, 'create'), 'uses' => $this->uses_str($parts, 'create')
		));

		$v = array_get($verbs, 'put', 'put');
		Route::$v($this->uri_str($parts, 'update'), array(
			'as' => $this->name_str($parts, 'update'), 'uses' => $this->uses_str($parts, 'update')
		));

		$v = array_get($verbs, 'delete', 'delete');
		Route::$v($this->uri_str($parts, 'destroy'), array(
			'as' => $this->name_str($parts, 'destroy'), 'uses' => $this->uses_str($parts, 'destroy')
		));

	}

	protected function uses_str($parts, $action = null)
	{
		if($action === null) $action = 'index';
		return $this->bundle_controller_pre().implode('.', $parts).'@'.$action;
	}

	protected function uri_str($parts, $action = null)
	{
		if($action !== null and ! in_array($action, array('new', 'create')))
			$parts[] = $action;

		$uri = $this->bundle_uri_pre().implode('/(:any)/', $parts);
		
		return ! in_array($action, array('new', 'create')) ? $uri : $uri.'/'.$action;
	}

	protected function name_str($parts, $action = null)
	{
		foreach($parts as $i=>$p)
		{
			if( $i === (count($parts)-1) )
				continue;
			$parts[$i] = Str::singular($p);
		}

		$parts = array_merge(array($this->bundle_pre()), $parts);

		if($action !== null)
		{
			$parts = array_merge(array($action), $parts);
			$parts[count($parts)-1] = Str::singular($parts[count($parts)-1]);
		}

		return implode('_', $parts);
	}

	public function add_resource($resource, array $verbs = array())
	{
		$this->_handled_resources[] = array($resource, $verbs);
		$this->route_resource($resource, $verbs);
		return $this;
	}
}