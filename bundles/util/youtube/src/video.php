<?php

namespace Youtube;

class Video
{
	const IFRAME_BASE = 'http://www.youtube.com/embed/';
	const FLASH_BASE = 'http://www.youtube.com/v/';
	const CHROMELESS_BASE = 'http://www.youtube.com/apiplayer';

	protected $_youtube_id = null;
	protected $_info = null;

	protected static function make_curl($url)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$res = curl_exec($ch);
		curl_close($ch);

		return $res;
	}

	public function __construct($youtube_id)
	{
		$this->_youtube_id = $youtube_id;
	}

	public static function make($youtube_id)
	{
		return new static($youtube_id);
	}

	protected static function extract_video_id_from_url($youtube_url)
	{
		$regex = '/v=([^&]+)/';
		preg_match($regex, $youtube_url, $matches);

		return @$matches[1];
	}

	public static function make_from_url($youtube_url)
	{
		return new static(static::extract_video_id_from_url($youtube_url));
	}

	protected static function url_params($attrs = [])
	{
		$url_params = null;
		foreach($attrs as $k=>$v)
			$url_params .= $url_params === null ? "?{$k}=".urlencode($v) : "&{$k}=".urlencode($v);

		return $url_params;
	}

	/******/
	public function api_url()
	{
		return 'http://gdata.youtube.com/feeds/api/videos/'.$this->_youtube_id.'?v=2&alt=jsonc';
	}

	public function info()
	{
		if($this->_info)
			return $this->_info;

		return $this->_info = json_decode(static::make_curl($this->api_url()));
	}
	/******/

	public function embedded_player_url($attrs = [])
	{
		return static::IFRAME_BASE . $this->_youtube_id . static::url_params($attrs);
	}

	public function flash_player_url($attrs = [])
	{
		$attrs += ['version' => 3];
		return static::FLASH_BASE . $this->_youtube_id . static::url_params($attrs);
	}

	public function chromeless_player_url($attrs = [])
	{
		$attrs += ['video_id' => $this->_youtube_id, 'version' => 3];
		return static::CHROMELESS_BASE . static::url_params($attrs);
	}

	public function embedded_player($attrs = [])
	{
		$attrs['src'] = $this->embedded_player_url((array) @$attrs['url']);

		return '<iframe'.HTML::attributes(['type' => 'text/html'] + $attrs).'></iframe>';
	}

	public function flash_player($attrs = [])
	{
		if(@$attrs['chromeless'])
			$attrs['src'] = $this->chromeless_player_url((array) @$attrs['url']);
		else
			$attrs['src'] = $this->flash_player_url((array) @$attrs['url']);

		return 
			'<object width="'.@$attrs['width'].'" height="'.@$attrs['height'].'">
				<param name="movie"
					value="'.@$attrs['src'].'">
				</param>
				<param name="allowScriptAccess" value="always"></param>
				<embed src="'.@$attrs['src'].'"
				    type="application/x-shockwave-flash"
				    allowscriptaccess="always"
				    width="'.@$attrs['width'].'" height="'.@$attrs['height'].'">
				</embed>
			</object>'
		;
	}
}