<?php

use Core\Media\Photo\Album;
use Core\Media\Photo;
use Core\Event\Model as Event;
use Core\Company\Model as Company;
use Core\Venue\Model as Venue;
use Core\Artist\Model as Artist;
use Core\IndustryPlayer\RegisterEntry as IndustryRegisterEntry;

class Admin_Media_Photo_Albums_Controller extends Crud_Base_Controller
{
	public $fields = ['name', 'owner_id'];

	public $relations = ['artists', 'venues', 'events', 'companies', 'photos'];

	public $base_uri = 'admin/media/photo/albums/';
	public $view_base = 'admin::media.photos.albums.';

	public function resource($id = null)
	{
		if($this->_resource)
			return $this->_resource;

		if($this->_action === 'edit')
			Album::with([
				'artists', 'artists.photos',
				'venues', 'venues.photos',
				'companies', 'companies.photos',
				'photos'
			]);

		return $this->_resource = $id === null ? new Album 
								: Album::with([
									'artists', 'artists.photos',
									'venues', 'venues.photos',
									'events', 'events.photos',
									'companies', 'companies.photos',
									'photos'
								 ])->find($id);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		return $this->_listing = Album::all();
	}

	public function listing_table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->column('id');
			$t->column('name');

			$t->rows($this->listing());
		});

		return $table;
	}

	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->fieldset('Photo Albums', function ($fs) {
				$fs->control('text', 'Name', function ($c) {
					$c->name = 'name';
					$c->value = Input::old('name', @$this->resource()->name);
				});

				$fs->control('select', 'Owner', function ($c) {
					$c->name = 'owner_id';
					$options = [0 => 'None'];
					foreach(IndustryRegisterEntry::all() as $ir)
						$options[$ir->type][$ir->id] = $ir->name;
					$c->options = $options;
					$c->value = Input::old('owner_id', @$this->resource()->owner_id);
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
					$c->value = Input::old('events', array_map(function ($a) { return $a->id; }, (array)@$this->resource()->events));
					$options = [];
					foreach(Event::all() as $a)
						$options[$a->id] = $a->name;
					$c->options = $options;
					$c->attr = ['multiple' => 'multiple'];
				});
			});

			$photos = [];

			foreach(['artists', 'venues'] as $connection) {
				foreach((array) @$this->resource()->$connection as $c) {
					foreach((array) @$c->photos as $p) {
						$photos[$p->id] = $p;
					}
					
					foreach((array) @$c->owned_photos as $p) {
						$photos[$p->id] = $p;
					}
				}
			}

			if($photos) {
				$f->fieldset('Photos', function ($fs) use ($photos) {
					foreach($photos as $id => $p) {
						$fs->control('input:checkbox', '', function ($c) use ($p) {
							$c->name = 'photos[]';
							$c->value = $p->id;
							
							$attr = ['data-src' => $p->get_url('icon')];
							if(in_array($p->id, Input::old('photos', array_map(function ($p) { return $p->id; }, @$this->resource()->photos))))
								$attr += ['checked' => 'checked'];

							$c->attr = $attr;
						});
					}
				});
			}
		});

		return $form;
	}
}