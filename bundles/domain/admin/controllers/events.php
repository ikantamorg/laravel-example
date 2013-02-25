<?php

use Core\Event\Model as Event;
use Core\Event\Type as EventType;
use Core\Artist\Model as Artist;
use Core\Venue\Model as Venue;
use Util\DateTimeOptions as DTO;

class Admin_Events_Controller extends Crud_Base_Controller
{
	public $fields = [
		'name',
		'about',
		'start_date',
		'end_date',
		'start_time',
		'end_time',
		'website_url',
		'facebook_url',
		'soundcloud_url',
		'source',
		'contact_numbers',
		'contact_emails',
		'is_timed', 
		'rating'
	];

	public $relations = [
		'artists',
		'songs',
		'videos',
		'venues',
		'profile_photo',
		'type',
		'classification_tags',
		'cover_photo'
	];

	public $view_base = 'admin::events.';
	public $base_uri = 'admin/events/';

	/**SEARCH STUFF**/

	public function search_aliases() {
		return [
			'all' => ['name', 'date', 'website_url', 'venue', 'type'],
			'name' => Event::$table . '.name',
			'date' => Event::$table . '.start_time',
			'website_url' => Event::$table . '.website_url',
			'facebook_url' => Event::$table . '.facebook_url',
			'venue' => Venue::$table . '.name',
			'type' => EventType::$table . '.name',
		];
	}

	/****************/

	/**HOOKS**/

	public function before_create()
	{
		Input::merge(['creator' => Auth::user()->id]);
		Input::merge(['contact_emails' => explode("\n", Input::get('contact_emails'))]);
		Input::merge(['contact_numbers' => explode("\n", Input::get('contact_numbers'))]);
	}

	public function before_update()
	{
		Input::merge(['creator' => Auth::user()->id]);
		Input::merge(['contact_emails' => explode("\n", Input::get('contact_emails'))]);
		Input::merge(['contact_numbers' => explode("\n", Input::get('contact_numbers'))]);
	}

	/*********/

	public function resource($id = null)
	{
		if($this->_resource)
			return $this->_resource;

		return $this->_resource = $id === null ? new Event : Event::with([
																'artists', 'artists.songs', 'artists.videos',
																'songs',
																'videos', 'venues',
																'venues.city'])->find($id);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		if($field = $this->get_searched_field()) {
			
			$q = Event::with(['venues', 'venues.city', 'type'])->left_join('core_event_venue', 'core_events.id', '=', 'core_event_venue.event_id');
			$q->left_join('core_event_types', 'core_events.type_id', '=', 'core_event_types.id');
			$q->left_join('core_venues', 'core_venues.id', '=', 'core_event_venue.venue_id')->select('core_events.*');

			$this->prepare_search_query($q, $field, Input::get($field));
		} else {
			$q = Event::with(['venues', 'venues.city', 'type']);
		}

		return $this->_listing = $q->order_by('start_time', 'desc')->order_by('rating', 'desc')->paginate(50);
	}

	public function total_records()
	{
		if($this->_total_records)
			return $this->_total_records;

		return $this->_total_records = Event::count();
	}

	public function activated_records()
	{
		if($this->_activated_records)
			return $this->_activated_records;

		return $this->_activated_records = Event::where_active(1)->count();
	}

	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->fieldset('Event', function ($fs) {
				$fs->control('text', 'Name', function ($c) {
					$c->name = 'name';
					$c->value = Input::old('name', @$this->resource()->name);
				});

				$fs->control('text', 'Rating', function ($c) {
					$c->name = 'rating';
					$c->value = Input::old('rating', @$this->resource()->rating);
				});

				$fs->control('select', 'Type', function ($c) {
					$c->name = 'type';
					$options = [0 => 'None'];
					foreach(EventType::all() as $et)
						$options[$et->id] = $et->name;
					$c->options = $options;
					$c->value = Input::old('type', @$this->resource()->type->id);
				});

				$fs->control('input:checkbox', 'Is Timed', function ($c) {
					$c->name = 'is_timed';
					$c->value = 1;
					$c->attr = (int) $this->resource()->is_timed === 1 ? ['checked' => 'checked'] : [];
				});

				$fs->control('text', 'Start Date', function ($c) {
					$c->name = 'start_date';
					$date = @$this->resource()->start_date;
					$c->value = Input::old('date', $date ? $date : (new DateTime)->format('d-m-Y'));
					$c->attr = ['class' => 'use-datepicker'];
				});

				$fs->control('text', 'End Date', function ($c) {
					$c->name = 'end_date';
					$date = @$this->resource()->end_date;
					$c->value = Input::old('date', $date ? $date : (new DateTime)->format('d-m-Y'));
					$c->attr = ['class' => 'use-datepicker'];
				});

				$fs->control('select', 'Start Time', function ($c) {
					$c->name = 'start_time';
					$options = [0 => ''];
					foreach(DTO::times() as $t)
						$options[$t] = $t;
					$c->options = $options;
					$c->value = Input::old('start_time', @$this->resource()->start_time);
				});

				$fs->control('select', 'End Time', function ($c) {
					$c->name = 'end_time';
					$options = [0 => ''];
					foreach(DTO::times() as $t)
						$options[$t] = $t;
					$c->options = $options;
					$c->value = Input::old('end_time', @$this->resource()->end_time);
				});

				$fs->control('text', 'Source', function ($c) {
					$c->name = 'source';
					$c->value = Input::old('source', @$this->resource()->source);
				});

				$fs->control('textarea', 'About', function ($c) {
					$c->name = 'about';
					$c->value = Input::old('about', @$this->resource()->about);
				});

				$fs->control('textarea', 'Contact Numbers', function ($c) {
					$c->name = 'contact_numbers';
					$c->value = Input::old('contact_numbers', implode("\n", (array)@$this->resource()->contact_numbers));
				});
				$fs->control('textarea', 'Contact Emails', function ($c) {
					$c->name = 'contact_emails';
					$c->value = Input::old('contact_emails', implode("\n", (array)@$this->resource()->contact_emails));
				});

				$fs->control('text', 'Website URL', function ($c) {
					$c->name = 'website_url';
					$c->value = Input::old('website_url', @$this->resource()->website_url);
				});

				$fs->control('text', 'Facebook URL', function ($c) {
					$c->name = 'facebook_url';
					$c->value = Input::old('facebook_url', @$this->resource()->facebook_url);
				});

				$fs->control('text', 'Soundcloud URL', function ($c) {
					$c->name = 'soundcloud_url';
					$c->value = Input::old('soundcloud_url', @$this->resource()->soundcloud_url);
				});
				
				$fs->control('select', 'Artists', function ($c) {
					$c->name = 'artists[]';
					$c->attr = ['multiple' => 'multiple'];
					
					$options = [];
					foreach(Artist::all() as $a)
						$options[$a->id] = $a->name;
					$c->options = $options;

					$c->value = Input::old('artists', array_map(function ($a){ return $a->id; }, (array) @$this->resource()->artists));
				});
				
				$fs->control('select', 'Venue', function ($c) {
					$c->name = 'venues[]';
					
					$options = [0 => 'None'];
					foreach(Venue::with('city')->get() as $v)
						$options[$v->id] = @$v->name.', '.@$v->city->name ;
					$c->options = $options;

					$c->attr = ['multiple' => 'multiple'];

					$c->value = Input::old('venues', array_map(function ($a){ return $a->id; }, (array) @$this->resource()->venues));
				});

				$fs->control('select', 'Songs', function ($c) {
					$c->name = 'songs[]';
					$options = [];

					$options = [];
					foreach(@$this->resource()->artists as $a)
						foreach($a->songs as $s)
							$options[$s->id] = $s->name;

					$c->options = $options;
					$c->attr = ['multiple' => 'multiple'];

					$c->value = Input::old('songs', array_map(function ($s) { return $s->id; }, (array) @$this->resource()->songs));
				});

				$fs->control('select', 'Videos', function ($c) {
					$c->name = 'videos[]';
					$options = [];

					$options = [];
					foreach(@$this->resource()->artists as $a)
						foreach($a->videos as $v)
							$options[$v->id] = $v->name;

					$c->options = $options;
					$c->attr = ['multiple' => 'multiple'];

					$c->value = Input::old('videos', array_map(function ($v) { return $v->id; }, (array) @$this->resource()->videos));
				});
				
			});

			$f->fieldset('Classification Tags', function ($fs) {
				$fs->control('select', '', function ($c) {
					$c->name = 'classification_tags[]';
					$options = [];
					foreach($this->resource()->classifiable_tags() as $t)
						$options[$t->id] = $t->name;
					$c->options = $options;
					$c->attr = ['multiple' => 'multiple'];
					$c->value = Input::old('genres', array_map(function ($g) { return $g->id; }, (array) @$this->resource()->classification_tags));
				});
			});

			if($this->resource()->exists) {
				$f->fieldset('Profile Photo', function ($fs) {
					$photos = [];
					
					foreach($this->resource()->photos as $p)
						$photos[$p->id] = $p;
										
					foreach($photos as $p)
					{
						$fs->control('input:radio', '', function ($c) use ($p) {
							$c->name = 'profile_photo';
							$c->value = $p->id;
							$c->attr = (int) $this->resource()->profile_photo_id === (int)$p->id ? 
												['checked' => 'checked', 'data-url' => $p->get_url('icon')]
											  : ['data-url' => $p->get_url('icon')];
						});
					}
				});

				$f->fieldset('Cover Photo', function ($fs) {
					$photos = [];
					
					foreach($this->resource()->photos as $p)
						$photos[$p->id] = $p;
										
					foreach($photos as $p)
					{
						$fs->control('input:radio', '', function ($c) use ($p) {
							$c->name = 'cover_photo';
							$c->value = $p->id;
							$c->attr = (int) $this->resource()->cover_photo_id === (int)$p->id ? 
												['checked' => 'checked', 'data-url' => $p->get_url('icon')]
											  : ['data-url' => $p->get_url('icon')];
						});
					}
				});
			}	
		});

		return $form;
	}

	public function listing_table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->column('id');
			$t->column('name');
			$t->column('rating');
			$t->column('Start_Time', function ($c) {
				$c->value = function($r) {
					return @$r->start_date.' '.@$r->start_time;
				};
			});

			$t->column('End_Time', function ($c) {
				$c->value = function ($r) {
					return @$r->end_date.' '.@$r->end_time;
				};
			});

			$t->column('venue', function ($c) {
				$c->value = function ($r) {
					return @$r->venue->name . ', ' . @$r->venue->city->name;
				};
			});

			$t->column('type', function ($c) {
				$c->value = function ($r) {
					return @$r->type->name;
				};
			});

			$t->column('', function ($c) {
				$c->value = function ($r) { return HTML::link(URL::to('admin/event/'.$r->id.'/photos'), 'Photos'); };
			});

			$t->column('', function ($c) {
				$c->value = function ($r) { return HTML::link(URL::to('admin/event/'.$r->id.'/organizers'), 'Organizers'); };
			});

			//$t->column('source');
			$t->column('website_url');
			$t->column('facebook_url');
			//$t->column('soundcloud_url');

			$t->rows($this->listing()->results);
		});

		return $table;
	}

	public function show_table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->column('name');
			$t->column('about');
			$t->column('website', function ($c) {
				$c->value = function ($r) { return HTML::link($r->website_url, $r->website_url); };
			});
			$t->column('facebook page', function ($c) {
				$c->value = function ($r) { return HTML::link($r->facebook_url, $r->facebook_url); };
			});
			$t->column('contact_numbers', function ($c) {
				$c->value = function ($r) {
					return implode(', ', (array)@$r->contact_numbers);
				};
			});
			$t->column('contact_emails', function ($c) {
				$c->value = function ($r) {
					return implode(', ', (array) @$r->contact_emails);
				};
			});
			$t->column('artists', function ($c) {
				$c->value = function ($r) {
					return implode(', ', array_map(function ($a) { return $a->name; }, $r->artists));
				};
			});
			$t->column('venue', function ($c) {
				$c->value = function ($r) {
					return @$r->venue->name;
				};
			});
			$t->column('profile_photo', function ($c) {
				$c->value = function ($r) {
					if($r->profile_photo)
						return HTML::image($r->profile_photo->get_url('thumb'), $r->profile_photo->alt);
				};
			});
			$t->column('Tagged Photos', function ($c) {
				$c->value = function ($r) {
					$html = '';
					foreach((array) @$r->photos as $p)
						$html .= HTML::image($p->get_url('icon'), $p->alt, ['class' => 'pull-left']);
					return $html;
				};
			});

			$t->rows([$this->resource()]);
		});

		return $table;
	}
}
