<?php

use Core\IndustryMember\MembershipTagConnection;
use Core\IndustryPlayer\RegisterEntry as IndustryRegisterEntry;

class Admin_Industryplayers_Membership_Tagconnections_Controller extends Crud_Base_Controller
{
	public $relations = ['connected_industry_player'];

	public $view_base = 'admin::industryplayers.memberships.tagconnections.';
	public $base_uri = 'admin/industryplayers/membership/tagconnections/';

	protected $_extend_listing_table = false;

	public function before()
	{
		$this->before_filter('block')->only(['new', 'create', 'show', 'destroy']);
	}

	public function resource($id = null)
	{
		if($this->_resource)
			return $this->_resource;

		return $this->_resource = MembershipTagConnection::with([
									'connected_industry_player',
									'industry_membership',
									'industry_membership.industry_member_profile',
									'industry_membership.industry_register_entry',
									'membership_tag'
								  ])->find($id);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		return $this->_listing = MembershipTagConnection::with([
									'connected_industry_player',
									'industry_membership',
									'industry_membership.industry_member_profile',
									'industry_membership.industry_register_entry',
									'membership_tag'
								  ])->get();
	}

	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->fieldset('Membership Tag Connection', function ($fs) {
				$fs->control('select', 'Connected Industry Player', function ($c) {
					$c->name = 'connected_industry_player';
					$options = [];
					foreach(IndustryRegisterEntry::all() as $e) {
						$options[$e->type][$e->id] = $e->name;
					}
					$c->options = $options;
					$c->value = Input::old('connected_industry_player', @$this->resource()->industry_player_id);
				});
			});
		});

		return $form;
	}

	public function listing_table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->column('id');
			$t->column('Membership', function ($c) {
				$c->value = function ($r) {
					return @$r->industry_membership->industry_member_profile->name .
							', '. @$r->industry_membership->industry_register_entry->name;
				};
			});

			$t->column('Tag', function ($c) {
				$c->value = function ($r) {
					return @$r->membership_tag->name;
				};
			});

			$t->column('Connected_Industry_Player', function ($c) {
				$c->value = function ($r) {
					return @$r->connected_industry_player->name . ', ' . 'Company';
				};
			});

			$t->column('', function ($c) {
				$c->value = function ($r) {
					return HTML::link(URL::to($this->base_uri.'edit/'.$r->id), 'Edit');
				};
			});

			$t->rows($this->listing());
		});

		return $table;
	}
}