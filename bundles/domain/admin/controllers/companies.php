<?php

use Core\Company\Model as Company;
use Core\Company\Tag as CompanyTag;
use Core\Artist\Model as Artist;
use Core\Venue\Model as Venue;
use Core\Event\Model as Event;
use Core\Geo\City;

class Admin_Companies_Controller extends Crud_Base_Controller
{
	public $fields = [
		'name',
		'about',
		'contact_numbers',
		'contact_emails',
		'manages_artists',
		'manages_venues',
		'manages_events',
	];

	public $relations = [
		'artists',
		'venues',
		'events',
		'tags',
		'city',
		'profile_photo'
	];

	public $view_base = 'admin::companies.';
	public $base_uri = 'admin/companies/';

	/***HOOKS**/

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

	/**********/

	public function resource($id = null)
	{
		if($this->_resource)
			return $this->_resource;

		return $this->_resource = $id === null ? new Company : Company::with(['tags'])->find($id);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		return $this->_listing = Company::with('tags')->all();
	}

	public function total_records()
	{
		if($this->_total_records)
			return $this->_total_records;

		return $this->_total_records = Company::count();
	}

	public function activated_records()
	{
		if($this->_activated_records)
			return $this->_activated_records;

		return $this->_activated_records = Company::where_active(1)->count();
	}

	public function listing_table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->column('id');
			$t->column('name');
			$t->column('city', function ($c) {
				$c->value = function ($r) {
					return @$r->city->name;
				};
			});
			$t->column('tags', function ($c) {
				$c->value = function ($r) {
					return implode(', ', array_map(function ($t) { return $t->name; }, (array) @$r->tags));
				};
			});

			$t->column('', function ($c) {
				$c->value = function ($r) {
					return HTML::link(URL::to($this->base_uri.'show/'.$r->id), 'Show');
				};
			});

			$t->rows($this->listing());
		});

		return $table;
	}

	public function show_table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->column('name');
			$t->column('city', function ($c) {
				$c->value = function ($r) {
					return @$r->city->name;
				};
			});
			$t->column('tags', function ($c) {
				$c->value = function ($r) {
					return implode(', ', array_map(function ($t) { return $t->name; }, (array) @$r->tags));
				};
			});
			$t->column('bio');
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
			$t->column('profile_photo', function ($c) {
				$c->value = function ($r) {
					if($r->profile_photo)
						return HTML::image($r->profile_photo->get_url('thumb'), $r->profile_photo->alt);
				};
			});

			$t->column('Owned Photos', function ($c) {
				$c->value = function ($r) {
					$html = '';
					foreach((array) @$r->register_entry->photos as $p)
						$html .= HTML::image($p->get_url('icon'), $p->alt, ['class' => 'pull-left']);
					return $html;
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

			$t->column('tags', function ($c) {
				$c->value = function ($r) {
					$html = '<ul class="nav nav-pills">';
					foreach((array) @$r->tags as $t) {
						$html .= '<li class="active"><a>'.$t->name.'</a></li>';
					}
					$html .= '</ul>';
					return $html;
				};
			});
			
			if((int) @$this->resource()->manages_events === 1)
				$t->column('Events', function ($c) {
					$c->value = function ($r) {
						return implode(',', array_map(function ($e) { return $e->name; }, (array) @$r->events));
					};
				});

			if((int) @$this->resource()->manages_artists === 1)
				$t->column('Artists', function ($c) {
					$c->value = function ($r) {
						return implode(', ', array_map(function ($a) { return $a->name; }, (array) @$r->artists));
					};
				});

			if((int) @$this->resource()->manages_venues === 1)
				$t->column('Venues', function ($c) {
					$c->value = function ($r) {
						return implode(', ', array_map(function ($v) { return $v->name; }, (array) @$r->venues));
					};
				});

			$t->rows([$this->resource()]);
		});

		return $table;
	}

	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->fieldset('Company', function ($fs) {
				$fs->control('text', 'Name', function ($c) {
					$c->name = 'name';
					$c->value = Input::old('name', @$this->resource()->name);
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
				$fs->control('input:checkbox', 'Manages Artists', function ($c) {
					$c->name = 'manages_artists';
					$c->value = 1;
					$c->attr = (int) @$this->resource()->manages_artists === 1 ? ['checked' => 'checked'] : [];
				});
				$fs->control('input:checkbox', 'Manages Events', function ($c) {
					$c->name = 'manages_events';
					$c->value = 1;
					$c->attr = (int) @$this->resource()->manages_events === 1 ? ['checked' => 'checked'] : [];
				});
				$fs->control('input:checkbox', 'Manages Venues', function ($c) {
					$c->name = 'manages_venues';
					$c->value = 1;
					$c->attr = (int) @$this->resource()->manages_venues === 1 ? ['checked' => 'checked'] : [];
				});

				$fs->control('select', 'Tags', function ($c) {
					$c->name = 'tags[]';
					$options = [];
					foreach(CompanyTag::all() as $t)
						$options[$t->id] = $t->name;
					$c->options = $options;
					$c->value = array_map(function ($t) { return $t->id; }, (array) @$this->resource()->tags);
					$c->attr = ['multiple' => 'multiple'];
				});

				$fs->control('select', 'City', function ($c) {
					$c->name = 'city';
					$options = [0 => 'None'];
					foreach(City::all() as $city)
						$options[$city->id] = $city->name;
					$c->options = $options;
					$c->value = @$this->resource()->city_id;
				});

				if((int) @$this->resource()->manages_artists === 1)
					$fs->control('select', 'Artists', function ($c) {
						$c->name = 'artists[]';
						$options = [];
						foreach(Artist::all() as $a)
							$options[$a->id] = $a->name;
						$c->options = $options;
						$c->value = array_map(function ($a) { return $a->id; }, (array) @$this->resource()->artists);
						$c->attr = ['multiple' => 'multiple'];
					});

				if((int) @$this->resource()->manages_events === 1)
					$fs->control('select', 'Events', function ($c) {
						$c->name = 'events[]';
						$options = [];
						foreach(Event::all() as $e)
							$options[$e->id] = $e->name;
						$c->options = $options;
						$c->value = array_map(function ($e) { return $e->id; }, (array) @$this->resource()->events);
						$c->attr = ['multiple' => 'multiple'];
					});

				if((int) @$this->resource()->manages_venues === 1)
					$fs->control('select', 'Venues', function ($c) {
						$c->name = 'venues[]';
						$options = [];
						foreach(Venue::all() as $v)
							$options[$v->id] = $v->name;
						$c->options = $options;
						$c->value = array_map(function ($v) { return $v->id; }, (array) @$this->resource()->venues);
						$c->attr = ['multiple' => 'multiple'];
					});
			});

			if($this->resource()->exists) {
				$f->fieldset('Profile Photo', function ($fs) {
					$photos = [];
					if($this->resource()->photos)
						$photos = array_merge($photos, $this->resource()->photos);
					if($this->resource()->owned_photos)
						$photos = array_merge($photos, $this->resource()->owned_photos);

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
			}
		});

		return $form;
	}
}