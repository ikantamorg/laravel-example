<?php

use Core\IndustryMember\MembershipTag;
use Core\IndustryPlayer\Map;

class Admin_IndustryPlayers_Membership_Tags_Controller extends Crud_Base_Controller
{
	public $fields = ['name', 'type'];
	public $view_base = 'admin::industryplayers.memberships.tags.';
	public $base_uri = 'admin/industryplayers/membership/tags/';

	public function resource($id = null)
	{
		if($this->_resource)
			return $this->_resource;

		return $this->_resource = $id === null ? new MembershipTag : MembershipTag::find($id);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		return $this->_listing = MembershipTag::all();
	}

	public function listing_table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->column('id');
			$t->column('name');
			$t->column('type');

			$t->rows($this->listing());
		});

		return $table;
	}

	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->fieldset('Membership Tag', function ($fs) {
				$fs->control('text', 'Name', function ($c) {
					$c->name = 'name';
					$c->value = Input::old('name', @$this->resource()->name);
				});

				$fs->control('select', 'Type', function ($c) {
					$c->name = 'type';
					$options = [];
					foreach(Map::mappings() as $slug => $class)
						$options[$slug] = $slug;
					$c->options = $options;
				});
			});
		});

		return $form;
	}	
}