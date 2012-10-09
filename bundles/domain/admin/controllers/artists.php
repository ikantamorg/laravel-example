<?php

use Core\Artist\Model as Artist;
use Core\Artist\Type as ArtistType;
use Core\Classification\Genre as Genre;
use Core\Geo\City;
use Core\Classification\Tag;

class Admin_Artists_Controller extends Crud_Base_Controller
{
	public $fields = [
		'name',
		'bio',
		'press_contact',
		'contact_numbers',
		'contact_emails',
		'facebook_url',
		'website_url',
		'soundcloud_url',
		'reverbnation_url',
	];

	public $relations = [
		'type',
		'current_city',
		'home_city',
		'genres',
		'profile_photo',
		'featured_songs',
		'classification_tags'
	];

	public $view_base = 'admin::artists.';
	public $base_uri = 'admin/artists/';

	/**SEARCH STUFF**/

	public function search_aliases() {
		return [
			'all' => ['name', 'press_contact', 'type', 'current_city'],
			'name' => Artist::$table.'.name',
			'press_contact' => Artist::$table.'.press_contact',
			'type' => ArtistType::$table.'.name',
			'current_city' => City::$table.'.name'
		];
	
	}

	/****************/

	/***HOOKS***/

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

	/***********/

	public function resource($id = null)
	{
		if($this->_resource)
			return $this->_resource;
		return $this->_resource = $id === null ? new Artist : Artist::with(['type', 'current_city', 'home_city', 'genres', 'featured_songs'])->find($id);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		if( $field = $this->get_searched_field() ) {
			$q = Artist::with(['type', 'current_city'])->left_join('core_artist_types', 'core_artists.type_id', '=', 'core_artist_types.id');
			$q->left_join('core_cities', 'core_artists.current_city_id', '=', 'core_cities.id')->select('core_artists.*');

			$this->prepare_search_query($q, $field, Input::get($field));	
		} else {
			$q = Artist::with(['type', 'current_city']);
		}

		$q = $q->order_by('name');

		return $this->_listing = $q->paginate(50);
	}

	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->fieldset('Artist', function ($fs) {
				$fs->control('text', 'Name', function ($c) {
					$c->name = 'name';
					$c->value = Input::old('name', @$this->resource()->name);
				});
				$fs->control('textarea', 'Bio', function ($c) {
					$c->name = 'bio';
					$c->value = Input::old('bio', @$this->resource()->bio);
				});
				$fs->control('textarea', 'Contact Numbers', function ($c) {
					$c->name = 'contact_numbers';
					$c->value = Input::old('contact_numbers', implode("\n", (array)@$this->resource()->contact_numbers));
				});
				$fs->control('textarea', 'Contact Emails', function ($c) {
					$c->name = 'contact_emails';
					$c->value = Input::old('contact_emails', implode("\n", (array)@$this->resource()->contact_emails));
				});
				$fs->control('text', 'Press Contact', function ($c) {
					$c->name = 'press_contact';
					$c->value = Input::old('press_contact', @$this->resource()->press_contact);
				});
				$fs->control('text', 'Facebook Url', function ($c) {
					$c->name = 'facebook_url';
					$c->value = Input::old('facebook_url', @$this->resource()->facebook_url);
				});
				$fs->control('text', 'Website Url', function ($c) {
					$c->name = 'website_url';
					$c->value = Input::old('website_url', @$this->resource()->website_url);
				});
				$fs->control('text', 'Soundcloud Url', function ($c) {
					$c->name = 'soundcloud_url';
					$c->value = Input::old('soundcloud_url', @$this->resource()->soundcloud_url);
				});
				$fs->control('text', 'Reverbnation Url', function ($c) {
					$c->name = 'reverbnation_url';
					$c->value = Input::old('reverbnation_url'. @$this->resource()->reverbnation_url);
				});
				$fs->control('select', 'Type', function ($c) {
					$c->name = 'type';
					$options = [0 => 'None'];
					foreach(ArtistType::all() as $a)
						$options[$a->id] = $a->name;
					$c->options = $options;
					$c->value = Input::old('type', @$this->resource()->type_id);
				});
				$fs->control('select', 'Current City', function ($c) {
					$c->name = 'current_city';
					$options = [0 => 'None'];
					foreach(City::all() as $cy)
						$options[$cy->id] = $cy->name;
					$c->options = $options;
					$c->value = Input::old('current_city', @$this->resource()->current_city_id);
				});
				$fs->control('select', 'Home City', function ($c) {
					$c->name = 'home_city';
					$options = [0 => 'None'];
					foreach(City::all() as $cy)
						$options[$cy->id] = $cy->name;
					$c->options = $options;
					$c->value = Input::old('home_city', @$this->resource()->home_city_id);
				});
				$fs->control('select', 'Genres', function ($c) {
					$c->name = 'genres[]';
					$options = [];
					foreach(Genre::all() as $g)
						$options[$g->id] = $g->name;
					$c->options = $options;
					$c->attr = ['multiple' => 'multiple'];
					$c->value = Input::old('genres', array_map(function ($g) { return $g->id; }, (array)@$this->resource()->genres));
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

			if(@$this->resource()->exists) {
				$f->fieldset('Featured', function ($fs) {
					if(@$this->resource()->songs) {
						$fs->control('select', 'Songs', function ($c) {
							$c->name = 'featured_songs[]';
							$options = [];
							foreach(@$this->resource()->songs as $s)
								$options[$s->id] = $s->name;
							$c->options = $options;
							$c->attr = ['multiple' => 'multiple'];
							$c->value = Input::old('featured_songs', array_map(function ($s) { return $s->id; }, (array) @$this->resource()->featured_songs));
						});
					}
				});
			}
		
			if($this->resource()->exists) {
				$f->fieldset('Profile Photo', function ($fs) {
					$photos = [];
					foreach($this->resource()->photos as $p)
						$photos[$p->id] = $p;

					foreach($this->resource()->owned_photos as $p)
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
			}
		});

		return $form;
	}

	public function listing_table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->column('id');
			$t->column('name');
			$t->column('press_contact');

			$t->column('Type', function ($c) {
				$c->value = function ($r) {
					return @$r->type->name;
				};
			});

			$t->column('Current_City', function ($c) {
				$c->value = function ($r) {
					return @$r->current_city->name;
				};
			});

			$t->column('', function ($c) {
				$c->value = function ($r) {
					return HTML::link(URL::to($this->base_uri.'show/'.$r->id), 'Show');
				};
			});

			$t->rows($this->listing()->results);
		});

		return $table;
	}

	public function show_table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->column('name');
			$t->column('type', function ($c) {
				$c->value = function ($r) {
					return @$r->type->name;
				};
			});
			$t->column('bio', function ($c) {
				$c->value = function ($r) {
					return @$r->bio;
				};
			});
			$t->column('press_contact');

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

			$t->column('Profile Photo', function ($c) {
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

			$t->column('genres', function ($c) {
				$c->value = function ($r) {
					$html = '<ul class="nav nav-pills">';
					foreach((array) @$r->genres as $g) {
						$html .= '<li class="active"><a>'.$g->name.'</a></li>';
					}
					$html .= '</ul>';
					return $html;
				};
			});

			$t->column('events', function ($c) {
				$c->value = function ($r) {
					$html = '<ul class="nav nav-pills">';
					foreach((array) @$r->events as $e) {
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