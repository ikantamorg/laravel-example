<?php

use Core\Event\Organizer;
use Core\Event\Model as Event;
use Core\IndustryMember\Profile as IndustryMemberProfile;
use Core\Company\Model as Company;

class Admin_Event_Organizers_Controller extends Crud_Base_Controller
{
	public $fields = [];
	public $relations = ['event', 'company', 'industry_member'];
	public $view_base = 'admin::events.organizers.';
	public $base_uri = null;

	protected $event_id = null;
	protected $event = null;

	/******************/

	public function set_event_id($id)
	{
		$this->event_id = $id;
		$this->base_uri = 'admin/event/'.$id.'/organizers/';
	}

	public function before()
	{
		$this->before_filter('event_check');
	}

	public function event_check()
	{
		if(! $this->event = Event::find($this->event_id) )
			return Response::error(404);

		View::share('event', $this->event);
	}

	public function before_create()
	{
		Input::merge(['event' => $this->event_id]);
	}

	public function before_update()
	{
		Input::merge(['event' => $this->event_id]);
	}

	/****************/

	public function resource($id = null)
	{
		if($this->_resource)
			return $this->_resource;

		return $this->_resource = $id === null ?
									  new Organizer 
									: Organizer::with(['event', 'company', 'industry_member'])
											   ->join(Event::$table, Event::$table.'.id', '=', Organizer::$table.'.event_id')
											   ->select(Organizer::$table.'.*')
											   ->where(Event::$table.'.id', '=', $this->event_id)
											   ->where(Organizer::$table.'.id', '=', $id)->first();
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		return $this->_listing = Organizer::with(['event', 'company', 'industry_member'])
											   ->join(Event::$table, Event::$table.'.id', '=', Organizer::$table.'.event_id')
											   ->select(Organizer::$table.'.*')
											   ->where(Event::$table.'.id', '=', $this->event_id)->get();
	}

	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->fieldset('Organizer', function ($fs) {
				$fs->control('select', 'Company', function ($c) {
					$c->name = 'company';
					$options = [0 => 'None'];
					foreach(Company::all() as $company)
						$options[$company->id] = $company->name;
					$c->options = $options;
					$c->value = @$this->resource()->company_id;
				});

				$fs->control('select', 'Industry Member', function ($c) {
					$c->name = 'industry_member';
					$options = [0 => 'None'];
					foreach(IndustryMemberProfile::all() as $im)
						$options[$im->id] = $im->name . ', ' . $im->email;
					$c->options = $options;
					$c->value = @$this->resource()->industry_member_id;
				});
			});
		});

		return $form;
	}

	public function listing_table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->column('id');
			$t->column('Company', function ($c) {
				$c->value = function ($r) {
					return @$r->company->name;
				};
			});
			$t->column('Industry Member', function ($c) {
				$c->value = function ($r) {
					return @$r->industry_member->name;
				};
			});

			$t->rows($this->listing());
		});

		return $table;
	}
}