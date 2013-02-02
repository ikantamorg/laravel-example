<?php

use Core\Tagable\Model as Tagable;
use Core\Classification\Tag\Type;

class Admin_Classification_Tag_Tagables_Controller extends Crud_Base_Controller
{
	public $relations = ['primary_tag_type', 'tag_types'];
	public $view_base = 'admin::classification.tags.tagables.';
	public $base_uri = 'admin/classification/tag/tagables/';

	public function resource($id = null)
	{
		if($this->_resource !== null)
			return $this->_resource;

		return $this->_resource = $id === null ? new Tagable : Tagable::with(['primary_tag_type', 'tag_types'])->find($id);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		return $this->_listing = Tagable::with(['primary_tag_type', 'tag_types'])->get();
	}

	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->fieldset('Tagable', function ($fs) {
				$fs->control('select', 'Tag Types', function ($c) {
					$c->name = 'tag_types[]';
					$c->attr = ['multiple' => 'multiple'];
					
					$options = [];
					foreach(Type::all() as $t)
						$options[$t->id] = $t->name;
					$c->options = $options;

					$c->value = array_map(function ($t) { return $t->id; }, (array) @$this->resource()->tag_types);
				});

				$fs->control('select', 'Primary Tag Type', function ($c) {
					$c->name = 'primary_tag_type';
					
					$options = [0 => 'None'];
					foreach((array) @$this->resource()->tag_types as $t)
						$options[$t->id] = $t->name;

					$c->options = $options;
					$c->value = @$this->resource()->primary_tag_type_id;
				});
			});
		});

		return $form;
	}

	public function listing_table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->column('id');
			$t->column('name');
			$t->column('slug');
			
			$t->rows($this->listing());
		});

		return $table;
	}

	/***********Override Creating functions***********/
	public function get_new()
	{
		return Response::error(404);
	}

	public function post_create()
	{
		return Response::error(404);
	}
	/*************************************************/
}