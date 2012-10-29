<?php

use Core\Artist\Model as Artist;

class Admin_Artist_Featured_Controller extends Rest_Controller
{
	public $restful = true;

	public $resource_type = 'artists';

	public $fields = ['type', 'resource_id'];
	public $view_base = 'admin::artists.featured.';
	public $base_uri = 'admin/artist/featured/';

	protected $_listing = [];

	protected function existing_featured_ids()
	{
		$rows = DB::table('core_featured')->where_type($this->resource_type)->select('resource_id')->get();
		return array_map(function ($r) { return $r->resource_id; }, $rows);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		$featured_ids = $this->existing_featured_ids();

		return $this->_listing = $featured_ids ? 
								  Artist::where_in('id', $featured_ids)->get()
								: [];
	}

	protected function listing_table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->attr(['class' => 'table table-striped table-bordered']);
			$t->empty_message = 'There are no records';

			$t->rows->attr = function ($row) {
				return ['id' => 'row-'.$row->id];
			};

			$t->column('id');
			$t->column('name');

			$t->rows($this->listing());
		});

		return $table;
	}

	protected function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->attr = ['method' => 'PUT', 'action' => URL::to($this->base_uri.'update')];

			$f->fieldset('Featured Artists', function ($fs) {
				$fs->control('select', 'Artists', function ($c) {
					$c->name = $this->resource_type.'[]';
					
					$options = [];
					foreach(Artist::all() as $a)
						$options[$a->id] = $a->name;
					$c->options = $options;

					$c->attr = ['multiple' => 'multiple'];
					$c->value = Input::old($this->resource_type, 
										array_map(function ($a) { return $a->id; }, $this->listing()));
				});
			});
		});

		return $form;
	}

	public function get_index()
	{
		return View::make($this->view_base.'index')->with([
					'table' => $this->listing_table(),
					'base_url' => URL::to($this->base_uri),
					'listing' => $this->listing()
				]);
	}

	public function get_edit()
	{
		return View::make($this->view_base.'edit')->with([
					'form' => $this->form(),
					'base_url' => URL::to($this->base_uri)
				]);
	}

	public function put_update()
	{
		$input_ids = Input::get($this->resource_type);
		$existing_ids = $this->existing_featured_ids();

		$new_ids = array_diff($input_ids, $existing_ids);
		$removed_ids = array_diff($existing_ids, $input_ids);

		if($removed_ids)
			DB::table('core_featured')->where_type($this->resource_type)->where_in('resource_id', $removed_ids)->delete();

		foreach($new_ids as $id)
			DB::table('core_featured')->insert(['type' => $this->resource_type, 'resource_id' => $id]);

		return Redirect::to($this->base_uri)->with('flash.success', $this->resource_type . 'featured succesfully');
	}
}