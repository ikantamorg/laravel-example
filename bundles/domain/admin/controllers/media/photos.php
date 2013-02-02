<?php

use Core\Media\Photo;
use Core\IndustryPlayer\RegisterEntry as IndustryRegisterEntry;
use Core\Artist\Model as Artist;
use Core\Event\Model as Event;
use Core\Venue\Model as Venue;

class Admin_Media_Photos_Controller extends Crud_Base_Controller
{
	public $fields = ['resource', 'owner_id', 'about', 'alt'];
	public $relations = ['artists', 'events', 'venues', 'companies'];
	public $view_base = 'admin::media.photos.';
	public $base_uri = 'admin/media/photos/';

	protected $_upload_driver = 'aws';
	
	public $uploaded_fields = [
		'photo' => ['image', 'resource']
	];

	public function search_aliases() {
		return [
			'all' => ['id', 'owner'],
			'id' => Photo::$table . '.id',
			'owner' => IndustryRegisterEntry::$table . '.name'
		];
	
	}

	public function resource($id = null)
	{
		if($this->_resource)
			return $this->_resource;

		return $this->_resource = null === $id ? new Photo : Photo::with(['industry_register_entry'])->find($id);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		$q = Photo::with('industry_register_entry')
					->left_join(
						IndustryRegisterEntry::$table,
						IndustryRegisterEntry::$table.'.id', '=', Photo::$table.'.owner_id'
					)->select(Photo::$table.'.*');

		if($field = $this->get_searched_field()) {
			
			$this->prepare_search_query($q, $field, Input::get($field));
		}

		$q->order_by('active', 'desc');

		return $this->_listing = $q->paginate(50);
	}

	public function total_records()
	{
		if($this->_total_records)
			return $this->_total_records;

		return $this->_total_records = Photo::count();
	}

	public function activated_records()
	{
		if($this->_activated_records)
			return $this->_activated_records;

		return $this->_activated_records = Photo::where_active(1)->count();
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
					$c->value = Input::old('events', array_map(function ($a) { return $a->id; }, (array)@$this->resource()->events));
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

			$t->rows($this->listing()->results);
		});

		return $table;
	}
}