<?php

use Core\Media\Photo;
use Core\IndustryPlayer\RegisterEntry as IndustryRegisterEntry;
use Core\Artist\Model as Artist;
use Core\Event\Model as Event;
use Core\Venue\Model as Venue;

class Admin_Event_Photos_Controller extends Crud_Base_Controller
{
	public $fields = ['resource', 'owner_id', 'about', 'alt'];
	public $relations = ['artists', 'events', 'venues', 'companies'];
	public $view_base = 'admin::events.photos.';
	public $base_uri = null;

	protected $_upload_driver = 'aws';

	public $uploaded_fields = [
		'photo' => ['image', 'resource']
	];

	protected $event_id = null;
	protected $event = null;

	public function set_event_id($id)
	{
		$this->event_id = $id;
		$this->base_uri = 'admin/event/'.$id.'/photos/';
	}

	/**************************/
	public function before()
	{
		$this->before_filter('event_check');
	}

	public function event_check()
	{
		if(! $this->event = Event::find($this->event_id) )
			return Response::error(404);
	}
	/***************************/

	public function before_create()
	{
		if(! in_array($this->event_id, $event_ids = Input::get('events')) )
		{
			$event_ids[] = $this->event_id;
			Input::merge('events', $event_ids);
		}
	}

	public function before_update()
	{
		if(! in_array($this->event_id, $event_ids = Input::get('events')) )
		{
			$event_ids[] = $this->event_id;
			Input::merge('events', $event_ids);
		}
	}

	/***************************/
	
	public function resource($id = null)
	{
		if($this->_resource)
			return $this->_resource;

		return $id === null ? new Photo 
							: Photo::with(['industry_register_entry'])
								   ->join('core_event_photo', 'core_event_photo.photo_id', '=', Photo::$table.'.id')
								   ->join(Event::$table, Event::$table.'.id', '=', 'core_event_photo.event_id')
								   ->select(Photo::$table.'.*')
								   ->where(Event::$table.'.id', '=', $this->event_id)
								   ->where(Photo::$table.'.id', '=', $id)->first();
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		return $this->listing = Photo::with(['industry_register_entry'])
									 ->join('core_event_photo', 'core_event_photo.photo_id', '=', Photo::$table.'.id')
									 ->join(Event::$table, Event::$table.'.id', '=', 'core_event_photo.event_id')
									 ->select(Photo::$table.'.*')
									 ->where(Event::$table.'.id', '=', $this->event_id)->get();

	}

	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->attr(['enctype' => 'multipart/form-data']);
			$f->fieldset('Photo', function ($fs) {
				$fs->control('select', 'Owner', function ($c) {
					$c->name = 'owner_id';
					$options = [0 => 'None'];
					foreach(IndustryRegisterEntry::all() as $ir)
						$options[$ir->type][$ir->id] = $ir->name;
					$c->options = $options;
					$c->value = Input::old('owner_id', @$this->resource()->owner_id);
				});

				$fs->control('text', 'Short desc', function ($c) {
					$c->name = 'alt';
					$c->value = Input::old('alt', @$this->resource()->alt);
				});

				$fs->control('text', 'Long Desc', function ($c) {
					$c->name = 'about';
					$c->value = Input::old('about', @$this->resource()->about);
					$c->attr = ['class' => 'span8'];
				});

				$fs->control('select', 'Artists', function ($c) {
					$c->name = 'artists[]';
					$c->value = Input::old('artists', array_map(function ($a) { return $a->id; }, (array)@$this->resource()->artists));
					$options = [];
					foreach(Artist::all() as $a)
						$options[$a->id] = $a->name;
					$c->options = $options;
					$c->attr = ['multiple' => 'multiple'];
				});

				$fs->control('select', 'Venues', function ($c) {
					$c->name = 'venues[]';
					$c->value = Input::old('venues', array_map(function ($a) { return $a->id; }, (array)@$this->resource()->venues));
					$options = [];
					foreach(Venue::all() as $a)
						$options[$a->id] = $a->name;
					$c->options = $options;
					$c->attr = ['multiple' => 'multiple'];
				});

				$fs->control('select', 'Events', function ($c) {
					$c->name = 'events[]';
					$connected_event_ids = array_map(function ($a) { return $a->id; }, (array)@$this->resource()->events) ? : [$this->event_id];
					$c->value = Input::old('events', $connected_event_ids);
					$options = [];
					foreach(Event::all() as $a)
						$options[$a->id] = $a->name;
					$c->options = $options;
					$c->attr = ['multiple' => 'multiple'];
				});

				$fs->control('input:file', 'Photo', function ($c) {
					$c->name = 'photo';
					$c->attr = ['data-src' => @$this->resource()->get_url('thumb')];
				});

				if($resource = Input::old('resource', @$this->resource()->resource))
					$fs->control('input:hidden', '', function ($c) use ($resource) {
						$c->name = 'resource';
						$c->value = $resource;
					});
			});
		});

		return $form;
	}

	public function listing_table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->column('id');
			$t->column('owner', function ($c) {
				$c->value = function ($r) { 
					return $r->industry_register_entry ? $r->industry_register_entry->name.', '.$r->industry_register_entry->type : null;
				};
			});

			$t->column('image', function ($c) {
				$c->value = function ($r) { return HTML::image($r->get_url('icon'), $r->alt); };
			});

			$t->rows($this->listing());
		});

		return $table;
	}
}