<?php

use Core\IndustryPlayer\RegisterEntry;

class Admin_Industryplayers_Register_Controller extends Crud_Base_Controller
{
	public $view_base = 'admin::industryplayers.register.';
	public $base_uri = 'admin/industryplayers/register/';

	/****flags****/
	protected $_extend_listing_table = false;
	/*************/

	/***Blocks***/
	
	public function before()
	{
		$this->before_filter('block')->only(['new', 'edit', 'create', 'update', 'destroy']);
	}

	/***************/

	/**SEARCH STUFF**/

	public function search_aliases() {
		return [
			'all' => ['name', 'type'],
			'name' => RegisterEntry::$table.'.name',
			'type' => RegisterEntry::$table.'.type',
		];
	
	}
	/*****************/

	public function resource($id = null)
	{
		if($this->_resource)
			return $this->_resource;

		return $this->_resource = $id === null ? null : RegisterEntry::find($id);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		if( $field = $this->get_searched_field() ) {
			$q = RegisterEntry::where('id', '>', 0);
			$this->prepare_search_query($q, $field, Input::get($field));
		} else {
			$q = RegisterEntry::where('id', '>', 0);
		}

		return $this->_listing = $q->paginate(50);
	}

	public function form()
	{
		return null;
	}

	public function listing_table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->column('id');
			$t->column('type');
			$t->column('name');

			$t->column('', function ($c) {
				$c->value = function ($r) {
					return HTML::link(URL::to($this->base_uri.'memberships/'.$r->id), 'Manage Memberships');
				};
			});

			$t->rows($this->listing()->results);
		});

		return $table;
	}

	public function get_memberships($id)
	{
		$register_entry = RegisterEntry::with(['memberships', 'memberships.industry_member_profile']);
		return View::make($this->view_base.'memberships')->with([
			'register_entry' => $register_entry,
			'base_url' => URL::to($this->base_uri)
		]);
	}

	public function put_memberships($id)
	{

	}
}