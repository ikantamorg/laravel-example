<?php

use Core\IndustryMember\Membership;
use Core\IndustryMember\Profile;
use Core\IndustryPlayer\RegisterEntry;
use Core\IndustryMember\MembershipTag;

class Admin_IndustryPlayers_Memberships_Controller extends Crud_Base_Controller
{
	public $fields = ['description', 'admin'];

	public $relations = [
		'industry_member_profile',
		'industry_register_entry',
		'tags'
	];

	public $view_base = 'admin::industryplayers.memberships.';

	public $base_uri = 'admin/industryplayers/memberships/';

	public function resource($id = null)
	{
		if($this->_resource)
			return $this->_resource;

		return $this->_resource = $id === null ? 
								  new Membership
								: Membership::with(['industry_member_profile', 'industry_register_entry', 'tags'])
											->find($id);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		return $this->_listing = Membership::with(['industry_member_profile', 'industry_register_entry', 'tags'])
										   ->get();
	}

	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->fieldset('Industry Membership', function ($fs) {
				$fs->control('select', 'Industry Member Profile', function ($c) {
					$c->name = 'industry_member_profile';
					$c->value = Input::old('industry_member_profile', @$this->resource()->industry_member_id);
					$options = [];
					foreach(Profile::all() as $p)
						$options[$p->id] = $p->name .', '. $p->email;
					$c->options = $options;
				});

				$fs->control('select', 'Industry Player', function ($c) {
					$c->name = 'industry_register_entry';
					$c->value = Input::old('industry_register_entry', @$this->resource()->industry_register_entry_id);
					$options = [];
					foreach(RegisterEntry::all() as $r)
						$options[$r->type] = isset($options[$r->type]) ? 
												  $options[$r->type] + [$r->id => $r->name]
												: [$r->id => $r->name];

					$c->options = $options;
				});

				$fs->control('text', 'Description', function ($c) {
					$c->name = 'description';
					$c->value = Input::old('description', @$this->resource()->description);
				});

				$fs->control('input:checkbox', 'Admin ?', function ($c) {
					$c->name = 'admin';
					$c->value = 1;
					$c->attr = (int) @$this->resource()->admin === 1 ? ['checked' => 'checked'] : [];
				});
			});
			
			if($this->resource()->exists)
			{
				$f->fieldset('Membership Tags', function ($fs) {
					$fs->control('select', '', function ($c) {
						$c->name = 'tags[]';
						$c->value = Input::old('tags', array_map(function ($t) { return $t->id; }, (array) @$this->resource()->tags));
						$options = [];
						
						$industry_register_entry_type = $this->resource()->industry_register_entry->type;
						
						foreach(MembershipTag::all() as $t) {
							if($t->type === $industry_register_entry_type)
								$options[$t->type] = isset($options[$t->type]) ? 
													  $options[$t->type] + [$t->id => $t->name]
													: [$t->id => $t->name];
						}

						$c->options = $options;
						$c->attr = ['multiple' => 'multiple'];
					});
				});
			}
			
		});

		return $form;
	}

	public function listing_table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->column('id');
			$t->column('Industry Player', function ($c) {
				$c->value = function ($r) {
					return @$r->industry_register_entry->name;
				};
			});
			$t->column('Industry Member', function ($c) {
				$c->value = function ($r) {
					return @$r->industry_member_profile->name;
				};
			});
			$t->column('Membership Tags', function ($c) {
				$c->value = function ($r) {
					return implode(',', array_map(function ($t) { return $t->name; }, (array) @$r->tags));
				};
			});
			$t->column('admin', function ($c) {
				$c->value = function ($r) {
					return (int)$r->admin === 1 ? 'Yes' : 'No';
				};
			});

			$t->column('description');

			$t->rows($this->listing());
		});

		return $table;
	}
}