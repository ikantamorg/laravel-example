<?php

namespace Core\Media;

use HTML;

use Core\Abstracts;

class Video extends Abstracts\MediaModel
{
	public static $table = 'core_videos';

	public static $accessible = [];

	/**Video URL constants**/
	const IFRAME_BASE = 'http://www.youtube.com/embed/';
	const FLASH_BASE = 'http://www.youtube.com/v/';
	const CHROMELESS_BASE = 'http://www.youtube.com/apiplayer';
	/***********************/

	public function before_delete()
	{
		parent::before_delete();
		$this->events()->sync([]);
		$this->artists()->sync([]);
		$this->genres()->sync([]);
	}

	public function before_save()
	{
		$this->slugify();
	}

	/**Relations and Setters/Getters**/

	public function type()
	{
		return $this->belongs_to('Core\\Media\\Video\\Type', 'type_id');
	}

	public function artists()
	{
		return $this->has_many_and_belongs_to('Core\\Artist\\Model', 'core_artist_video', 'video_id', 'artist_id');
	}

	public function events()
	{
		return $this->has_many_and_belongs_to('Core\\Event\\Model', 'core_event_video', 'video_id', 'event_id');
	}

	public function genres()
	{
		return $this->has_many_and_belongs_to('Core\\Classification\\Genre', 'core_video_genre', 'video_id', 'genre_id');
	}

	public function industry_register_entry()
	{
		return $this->belongs_to('Core\\IndustryPlayer\\RegisterEntry', 'owner_id');
	}

	/**Player URLS**/
	
	public function get_embedded_player_url($attrs = [])
	{
		return static::IFRAME_BASE . $this->get_attribute('youtube_id') . $this->url_params($attrs);
	}

	public function get_flash_player_url($attrs = [])
	{
		$attrs += ['version' => 3];
		return static::FLASH_BASE . $this->get_attribute('youtube_id') . $this->url_params($attrs);
	}

	public function get_chromeless_player_url($attrs = [])
	{
		$attrs += ['video_id' => $this->get_attribute('youtube_id'), 'version' => 3];
		return static::CHROMELESS_BASE . $this->url_params($attrs);
	}

	/**************/

	public function get_embedded_player($attrs = [])
	{
		if(! isset($attrs['src']) )
			return null;

		return '<iframe'.HTML::attributes(['type' => 'text/html'] + $attrs).'></iframe>';
	}

	public function get_flash_player($attrs = [])
	{
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