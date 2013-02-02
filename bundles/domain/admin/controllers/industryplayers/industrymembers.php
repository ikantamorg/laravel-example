<?php

use Core\IndustryMember\Profile;

class Admin_Industryplayers_Industrymembers_Controller extends Crud_Base_Controller
{
	public $fields = ['name', 'email', 'phone', 'address', 'facebook_url'];
	public $relations = ['city'];

	public $view_base = 'admin::industryplayers.industrymembers.';
	public $base_uri = 'admin/industryplayers/industrymembers/';

	public function resource($id = null)
	{
		if($this->_resource)
			return $this->_resource;

		return $this->_resource = $id === null ? 
									new Profile 
								  : Profile::with(['city', 'industry_memberships.register_entry'])->find($id);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		return $this->_listing = Profile::with('city')->get();
	}

	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->fieldset('Industry Members', function ($fs) {
				$fs->control('text', 'Name', function ($c) {
					$c->name = 'name';
					$c->value = Input::old('name', @$this->resource()->name);
				});
				$fs->control('text', 'Email', function ($c) {
					$c->name = 'email';
					$c->value = Input::old('email', @$this->resource()->email);
				});
				$fs->control('text', 'Phone', function ($c) {
					$c->name = 'phone';
					$c->value = Input::old('phone', @$this->resource()->phone);
				});
				$fs->control('text', 'Address', function ($c) {
					$c->name = 'address';
					$c->value = Input::old('address', @$this->resource()->address);
				});
				$fs->control('text', 'Facebook URL', function ($c) {
					$c->name = 'facebook_url';
					$c->value = Input::old('facebook_url', @$this->resource()->facebook_url);
				});
			});
		});

		return $form;
	}

	public function listing_table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->column('name');
			$t->column('email');
			$t->column('phone');
			$t->column('facebook_url');

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
			$t->column('email');
			$t->column('email');
			$t->column('phone');
			$t->column('Connected Industry Player', function ($c) {
				$c->value = function ($r) {
					if(! (array) @$r->industry_memberships )
						return false;

					$register_entries = array_map(function ($m) { return $m->industry_register_entry; }, (array) $r->industry_memberships);

					$table = Hybrid\Table::make(function ($t) use ($register_entries) {
						$t->column('name');
						$t->column('type');
						$t->empty_message = 'No memberships';
						$t->rows($register_entries);
					});

					return $table->render();
				};
			});

			$t->rows([$this->resource()]);
		});

		return $table;
	}
}