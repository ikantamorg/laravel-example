<?php

use Core\Media\Song;
use Core\IndustryPlayer\RegisterEntry as IndustryRegisterEntry;
use Core\Artist\Model as Artist;
use Core\Classification\Genre;
use Core\Event\Model as Event;

class Admin_Media_Songs_Controller extends Crud_Base_Controller
{
	public $fields = ['name', 'stream_url', 'soundcloud_url', 'owner_id', 'provider'];
	public $relations = ['artists', 'genres', 'events'];
	public $view_base = 'admin::media.songs.';
	public $base_uri = 'admin/media/songs/';

	protected $_upload_driver = 'aws';

	public $uploaded_fields = [
		'audio' => ['audio', 'stream_url']
	];

	public function resource($id = null)
	{
		if($this->_resource)
			return $this->_resource;

		return $this->_resource = $id === null ? new Song : Song::with(['artists', 'genres', 'events'])->find($id);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		return $this->_listing = Song::all();
	}

	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->attr(['enctype' => 'multipart/form-data']);
			$f->fieldset('Song Details', function ($fs) {
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
					$c->attr = ['multiple' => 'multiple'];
					$options = [];
					foreach(Artist::all() as $a)
						$options[$a->id] = $a->name;
					$c->options = $options;
					$c->value = Input::old('artists', array_map(function ($a) { return $a->id; }, (array) @$this->resource()->artists));
				});

				$fs->control('select', 'genres', function ($c) {
					$c->name = 'genres[]';
					$c->attr = ['multiple' => 'multiple'];
					$options = [];
					foreach(Genre::all() as $g)
						$options[$g->id] = $g->name;
					$c->options = $options;
					$c->value = Input::old('genres', array_map(function ($g) { return $g->id; }, (array) @$this->resource()->genres));
				});

				$fs->control('select', 'Events', function ($c) {
					$c->name = 'events[]';
					$c->attr = ['multiple' => 'multiple'];
					$options = [];
					foreach(Event::all() as $e)
						$options[$e->id] = $e->name;
					$c->options = $options;
					$c->value = Input::old('events', array_map(function ($e) { return $e->id; }, (array) @$this->resource()->events));
				});

				$fs->control('text', 'Soundcloud URL', function ($c) {
					$c->name = 'soundcloud_url';
					$c->attr = ['multiple' => 'multiple'];
					$c->value = Input::old('soundcloud_url', @$this->resource()->soundcloud_url);
				});

				$fs->control('input:file', 'Audio File', function ($c) {
					$c->name = 'audio';
				});
			});
		});

		return $form;
	}

	public function listing_table()
	{
		$table = Hybrid\Table::make(function($t) {
			$t->column('id');
			$t->column('name');
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
			$t->column('id');
			$t->column('name');

			$t->rows([$this->resource()]);
		});

		return $table;
	}
}