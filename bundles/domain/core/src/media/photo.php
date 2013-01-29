<?php

namespace Core\Media;

use Locator;
use Core\Abstracts;

class Photo extends Abstracts\MediaModel
{
	public static $table = 'core_photos';

	public function before_delete()
	{
		parent::before_delete();
		$this->artists()->sync([]);
		$this->venues()->sync([]);
		$this->events()->sync([]);
	}

	/**Relations and Setters/Getters**/

	public function artists()
	{
		return $this->has_many_and_belongs_to('Core\\Artist\\Model', 'core_artist_photo', 'photo_id', 'artist_id');
	}

	public function venues()
	{
		return $this->has_many_and_belongs_to('Core\\Venue\\Model', 'core_venue_photo', 'photo_id', 'venue_id');
	}

	public function events()
	{
		return $this->has_many_and_belongs_to('Core\\Event\\Model', 'core_event_photo', 'photo_id', 'event_id');
	}

	public function companies()
	{
		return $this->has_many_and_belongs_to('Core\\Company\\Model', 'core_company_photo', 'photo_id', 'company_id');
	}

	public function get_url($format = null)
	{
		return Locator::aws()->locate($this->resource)->format($format)->url();
	}
}