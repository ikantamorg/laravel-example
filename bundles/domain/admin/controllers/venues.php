<?php

use Core\Venue\Model as Venue;
use Core\Geo\City, Core\Venue\Tag;

class Admin_Venues_Controller extends Crud_Base_Controller
{
	public $fields = ['name', 'address', 'about', 'website', 'facebook_url', 'contact_numbers', 'contact_emails'];
	public $relations = ['city', 'tags', 'creator', 'profile_photo'];
	public $view_base = 'admin::venues.';
	public $base_uri = 'admin/venues/';

	/****HOOKS***/

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

	/************/
	
	public function resource($id = null)
	{
		if($this->_resource)
			return $this->_resource;

		return $this->_resource = $id === null ? new Venue : Venue::with(['city'])->find($id);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		return $this->_listing = Venue::with(['city', 'tags', 'creator'])->get();
	}

	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->attr(['enctype' => 'multipart/form-data']);
			$f->fieldset('Venue', function ($fs) {
				$fs->control('text', 'Name', function($c) {
					$c->name = 'name';
					$c->value = Input::old('name', @$this->resource()->name);
				});
				$fs->control('text', 'Address', function ($c) {
					$c->name = 'address';
					$c->value = Input::old('address', @$this->resource()->address);
				});
				$fs->control('textarea', 'About', function ($c) {
					$c->name = 'about';
					$c->value = Input::old('about', @$this->resource()->about);
				});
				$fs->control('text', 'Website', function ($c) {
					$c->name = 'website';
					$c->value = Input::old('website', @$this->resource()->website);
				});
				$fs->control('text', 'Facebook URL', function ($c) {
					$c->name = 'facebook_url';
					$c->value = Input::old('facebook_url', @$this->resource()->website);
				});
				$fs->control('textarea', 'Contact Numbers', function ($c) {
					$c->name = 'contact_numbers';
					$c->value = Input::old('contact_numbers', implode("\n", (array)@$this->resource()->contact_numbers));
				});
				$fs->control('textarea', 'Contact Emails', function ($c) {
					$c->name = 'contact_emails';
					$c->value = Input::old('contact_emails', implode("\n", (array)@$this->resource()->contact_emails));
				});
				$fs->control('select', 'City', function ($c) {
					$c->name = 'city';
					$c->value = Input::old('city', @$this->resource()->city_id);
					$options = [0 => 'None'];
					foreach(City::all() as $city)
						$options[$city->id] = $city->name;

					$c->options = $options;
				});
				$fs->control('select', 'Tags', function ($c) {
					$c->name = 'tags[]';
					$c->value = Input::old('tags', array_map(function ($t) { return $t->id; }, (array) @$this->resource()->tags));
					$options = [];
					foreach(Tag::all() as $t)
						$options[$t->id] = $t->name;
					$c->options = $options;
					$c->attr = ['multiple' => 'multiple'];
				});
			});

			if($this->resource()->exists) {
				$f->fieldset('Profile Photo', function ($fs) {
					$photos = [];
					if($this->resource()->photos)
						$photos = array_merge($photos, (array) @$this->resource()->photos);
					if($this->resource()->owned_photos)
						$photos = array_merge($photos, (array) @$this->resource()->owned_photos);

					$fs->control('input:radio', 'None', function ($c) {
						$c->name = 'profile_photo';
						$c->value = 0;
						$c->attr = (int) $this->resource()->profile_photo_id === 0 ? ['checked' => 'checked'] : [];
					});

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

	public function listing_table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->column('id');
			$t->column('name');
			$t->column('city', function ($c) {
				$c->value = function ($r) { return @$r->city->name; };
			});
			$t->column('website');
			$t->column('facebook_url');
			$t->column('creator', function ($c) {
				$c->value = function ($r) { return @$r->creator->username; };
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

			$t->column('address');
			$t->column('about');

			$t->column('contact_number');
			$t->column('contact_email');
			
			$t->column('website', function ($c) {
				$c->value = function ($r) { return HTML::link(@$r->website, @$r->website); };
			});
			$t->column('facebook_url', function ($c) {
				$c->value = function ($r) { return HTML::link(@$r->facebook_url, @$r->facebook_url); };
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
					foreach((array) @$r->owned_photos as $p)
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
					foreach($r->tags as $t) {
						$html .= '<li class="active"><a>'.$t->name.'</a></li>';
					}
					$html .= '</ul>';
					return $html;
				};
			});

			$t->column('Events', function ($c) {
				$c->value = function ($r) {
					$html = '<ul class="nav nav-pills">';
					foreach($r->events as $e) {
						$html .= '<li class="active"><a>'.$e->name.'</a></li>';
					}
					$html .= '</ul>';
					return $html;
				};
			});

			$t->rows([$this->resource()]);
		});

		return $table;
	}
}
