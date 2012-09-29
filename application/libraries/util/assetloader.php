<?php

namespace Util;

class AssetLoaderException extends Exception { }

class AssetLoader
{
	protected $_container = null;
	protected $_pre = null;
	protected $_ext = null;

	public function __construct($type, $container)
	{
		$this->_container = $container;
		$this->_pre = $type . '/';
		$this->_ext = '.' . $_ext;
	}

	public function load(array $tree)
	{
		$this->real_loader($tree, $this->_pre, $this->_ext);
	}

	protected function real_loader($tree, $pre, $ext)
	{
		foreach($tree as $k=>$v) {
			if(is_array($v))
				$this->real_loader($v, $pre.$k.'/', $ext);
			else
				$this->_container->add($pre.$v, $pre.$v.$ext);
		}
	}
}