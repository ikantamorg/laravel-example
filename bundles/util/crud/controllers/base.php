<?php

class RelationDataException extends Exception { }

abstract class Crud_Base_Controller extends App_Controller
{
	public $restful = true;

	public $fields = [];
	public $relations = [];
	public $view_base = null;
	public $base_uri = null;

	public $uploaded_fields = [];

	protected $_resource = null;
	protected $_listing = [];
	protected $_total_records = null;
	protected $_activated_records = null;
	protected $_action = null;
	protected $_response = null;

	/****FLAGS****/

	protected $_extend_listing_table = true;

	/*************/

	/****Upload Driver****/

	protected $_upload_driver = 'laravel';

	/*********************/

	/**Callbacks Stuff**/

	protected static $valid_callbacks = [
		'before_upload', 'after_upload',

		'before_persist', 'after_persist',

		'before_action', 'after_action',

		'before_index', 'after_index',

		'before_show', 'after_show',

		'before_new', 'after_new',

		'before_create', 'after_create',

		'before_edit', 'after_edit',

		'before_update', 'after_update',

		'before_destroy', 'after_destroy',

		'before_activate', 'after_activate',

		'before_deactivate', 'after_deactivate'
	];

	protected function invoke_callback($name)
	{
		if (method_exists($this, $name))
		{
			$this->$name();
		}
	}

	/************************/

	/**abstract stuff + a thing to be extended**/

	abstract public function listing_table();
	abstract public function form();
	abstract public function resource($id);
	abstract public function listing();
	
	public function total_records()
	{
		return null;
	}

	public function activated_records()
	{
		return null;
	}

	public function show_table()
	{

	}

	/*******************************************/

	public function block()
	{
		return Response::error(404);
	}

	/*****************SEARCH STUFF**************/

	public function search_aliases() {
		return [];
	}

	protected function search_alias($field)
	{
		return @$this->search_aliases()[$field];
	}

	protected function prepare_search_query($q, $param, $val)
	{
		if($this->search_alias($param) === null)
			return $q;

		Session::put('searched_field', $param);

		if( is_array($this->search_alias($param)) )
		{
			foreach($this->search_alias($param) as $i => $p) {
				if($i === 0)
					$q->where($this->search_alias($p), 'like', '%'.$val.'%');
				else
					$q->or_where($this->search_alias($p), 'like', '%'.$val.'%');
			}
		}
		else
		{
			$q->where($this->search_alias($param), 'like', '%'.$val.'%');
		}

		return $q;
	}

	public function get_searched_field()
	{
		foreach($this->search_aliases() as $a => $v) {
			if(Input::get($a))
				return $a;
		}

		return null;
	}

	/****************************************/

	/**uploader runner**/

	protected function run_uploader()
	{
		$this->invoke_callback('before_upload');

		Uploader::driver($this->_upload_driver)->fields($this->uploaded_fields)->attach();

		$this->invoke_callback('after_upload');
	}

	/*******************/

	/**the persister**/

	protected function persist($model, $data) 
	{
		/**Start DB transaction so that all the changes are commited**/
		DB::connection()->pdo->beginTransaction();

		try {

			$this->invoke_callback('before_persist');

			foreach($this->fields as $f)
			{
				if(null !== $val = @$data[$f])
					$model->$f = @$data[$f];
			}

			if($model->save())
			{
				foreach($this->relations as $r)
				{
					$relation = $model->$r();

					if( ! in_array($relation_class = class_basename($relation), ['Has_Many', 'Belongs_To', 'Has_Many_And_Belongs_To']) )
					{
						throw new RelationDataException('Invalid Relation : '.$r . ' on model ' . get_called_class());
					}

					$attachment = get_class($relation->model);

					if($relation_class === 'Has_Many_And_Belongs_To')
					{
						$ids = (array) @$data[$r];
						if($ids)
							$real_ids = array_map(function ($m) { return $m->id; }, $attachment::where_in('id', $ids)->get());
						else
							$real_ids = [];
						
						$model->$r()->sync($real_ids);
					}
					elseif($relation_class === 'Belongs_To')
					{
						$id = (int) @$data[$r];

						if($attached_model = $attachment::find($id))
						{
							$model->{$relation->foreign_key()} = $attached_model->id;
							$model->save();
						}
						else
						{
							$model->{$relation->foreign_key()} = 0;
							$model->save();
						}
					}
					elseif($relation_class === 'Has_Many')
					{
						if($data = (array) @$data[$r])
						{
							if(is_array(head($data)))
							{

							}
						}
					}
				}

				$this->invoke_callback('after_persist');
				/**So Models and relationships are saved, all the data processed, now do the commit**/
				DB::connection()->pdo->commit();
				return true;				
			}
			else
			{
				$this->invoke_callback('after_persist');
				/**Models aren't saved, so no query runs, so just rollback stuff**/
				DB::connection()->pdo->rollBack();
				return false;
			}

		} catch(Exception $e) {
			DB::connection()->pdo->rollBack();
			throw $e;
		}
	}

	/************/

	public function get_index()
	{
		$this->_action = 'index';

		$this->invoke_callback('before_action');
		$this->invoke_callback('before_index');

		$table = $this->listing_table();

		$table->extend(function ($t) {
			$t->attr(['class' => 'table table-striped table-bordered']);
			$t->empty_message = 'There are no records';

			$t->rows->attr = function ($row) {
				return ['id' => 'row-'.$row->id];
			};

			if($this->_extend_listing_table) {
				$t->column('', function ($col) {
					$col->value = function ($row) { 
						return HTML::link(URL::to($this->base_uri) . 'edit/' . $row->id, 'Modify');
					};
				});
				$t->column('', function ($col) {
					$col->value = function ($row) { 
						return HTML::link(URL::to($this->base_uri) . 'destroy/' . $row->id, 'Delete');
					};
				});
				$t->column('', function ($col) {
					$col->value = function ($row) {
						if($row->active)
							return HTML::link(URL::to($this->base_uri) . 'deactivate/' . $row->id, 'Deactivate');
						else
							return HTML::link(URL::to($this->base_uri) . 'activate/' . $row->id, 'Activate');
					};
				});
			}
		});

		$this->_response =  View::make($this->view_base.'index')
									->with('table', $table)
									->with('base_url', URL::to($this->base_uri))
									->with('listing', $this->listing())
									->with('total_records', $this->total_records())
									->with('activated_records', $this->activated_records());

		$this->invoke_callback('after_index');
		$this->invoke_callback('after_action');

		return $this->_response;
	}

	public function get_show()
	{
		$this->_action = 'show';

		$this->invoke_callback('before_action');
		$this->invoke_callback('before_show');

		$args = func_get_args();
		$id = end($args);
		
		if( ! $resource = $this->resource($id) ) {
			$this->_response = Response::error(404);
			$this->invoke_callback('after_show');
			$this->invoke_callback('after_action');
			return $this->_response;
		}

		$table = $this->show_table();

		$table->extend(function ($t) {
			$t->attr(['class' => 'table table-striped table-bordered']);
			$t->empty_message = "There are no records";
			$t->layout('vertical');
		});
		
		$this->_response = View::make($this->view_base.'show')
								->with('table', $table)
								->with('base_url', URL::to($this->base_uri))
								->with('resource', $this->resource());

		$this->invoke_callback('after_show');
		$this->invoke_callback('after_action');

		return $this->_response;
	}

	public function get_new()
	{
		$this->_action = 'new';

		$this->invoke_callback('before_action');
		$this->invoke_callback('before_new');

		$form = $this->form();
		$form->extend(function ($f) {
			$f->attr(['method' => 'POST', 'action' => URL::to($this->base_uri.'create')]);
		});
		
		$this->_response =  View::make($this->view_base.'new')
									->with('form', $form)
									->with('base_url', URL::to($this->base_uri))
									->with('resource', $this->resource());

		$this->invoke_callback('after_new');
		$this->invoke_callback('after_action');

		return $this->_response;
	}

	public function post_create()
	{
		$this->_action = 'create';
		
		$this->invoke_callback('before_action');
		$this->invoke_callback('before_create');

		$this->run_uploader();		

		$resource = $this->resource();
		if($this->persist($resource, Input::get()))
		{
			$this->_response = Redirect::to($this->base_uri)->with('flash.success', 'Resource added Successfully');
		}
		else
		{
			Input::flash();
			$this->_response = Redirect::to($this->base_uri."new")->with_errors($resource->errors)
													  ->with('flash.error', 'There were errors in your form');
		}

		$this->invoke_callback('after_create');
		$this->invoke_callback('after_action');

		return $this->_response;
	}

	public function get_edit()
	{
		$this->_action = 'edit';

		$this->invoke_callback('before_action');
		$this->invoke_callback('before_edit');

		$args = func_get_args();
		$id = end($args);

		if( ! $resource = $this->resource($id) ) {
			$this->_response = Response::error(404);
			$this->invoke_callback('after_edit');
			$this->invoke_callback('after_action');
			return $this->_response;
		}

		$form = $this->form();
		$form->extend(function ($f) use ($resource) {
			$f->attr(['method' => 'PUT', 'action' => URL::to($this->base_uri.'update/'.$resource->id)]);
		});
				
		$this->_response = View::make($this->view_base.'edit')
						->with('form', $form)
						->with('model', class_basename($resource))
						->with('base_url', URL::to($this->base_uri))
						->with('resource', $this->resource());

		$this->invoke_callback('after_edit');
		$this->invoke_callback('after_action');

		return $this->_response;
	}

	

	public function put_update()
	{
		$this->_action = 'update';

		$this->invoke_callback('before_action');
		$this->invoke_callback('before_update');

		$this->run_uploader();

		$args = func_get_args();
		$id = end($args);

		if(! $resource = $this->resource($id)) {
			$this->_response = Response::error(404);
			$this->invoke_callback('after_update');
			$this->invoke_callback('after_action');
			return $this->_response;
		}
			

		if($this->persist($resource, Input::get()))
		{
			$this->_response = Redirect::to($this->base_uri);
		}
		else
		{
			Input::flash();
			$this->_response = Redirect::to($this->base_uri."edit/{$id}")->with_errors($resource->errors)
															 ->with('flash.error', 'There were errors in your form');
		}

		$this->invoke_callback('after_update');
		$this->invoke_callback('after_action');

		return $this->_response;
	}

	public function get_destroy()
	{
		$args = func_get_args();
		$id = end($args);
		
		return $this->delete_destroy($id);
	}

	public function delete_destroy()
	{
		$this->_action = 'destroy';

		$this->invoke_callback('before_action');
		$this->invoke_callback('before_destroy');

		$args = func_get_args();
		$id = end($args);
				
		if( ! $resource = $this->resource($id) ) {
			$this->_response = Response::error(404);
		} else {
			$resource->delete();
			$this->_response = Redirect::to(URL::to($this->base_uri))->with('flash.success', 'Resource deleted successfuly');
		}

		$this->invoke_callback('after_destroy');
		$this->invoke_callback('after_action');

		return $this->_response;
	}

	public function get_activate()
	{
		$args = func_get_args();
		$id = end($args);

		return $this->put_activate($id);
	}

	public function put_activate()
	{
		$this->_action = 'activate';

		$this->invoke_callback('before_action');
		$this->invoke_callback('before_activate');

		$args = func_get_args();
		$id = end($args);

		if(! $resource = $this->resource($id) )
		{
			$this->_response = Response::error(404);
		}
		else
		{
			$resource->activate();
			$this->_response = Redirect::to(URL::to($this->base_uri))->with('flash.success', 'Resource Activated');
		}

		$this->invoke_callback('after_activate');
		$this->invoke_callback('after_action');

		return $this->_response;
	}

	public function get_deactivate()
	{
		$args = func_get_args();
		$id = end($args);

		return $this->put_deactivate($id);
	}

	public function put_deactivate()
	{
		$this->_action = 'deactivate';

		$this->invoke_callback('before_action');
		$this->invoke_callback('before_deactivate');

		$args = func_get_args();
		$id = end($args);

		if(! $resource = $this->resource($id) )
		{
			$this->_response = Response::error(404);
		}
		else
		{
			$resource->deactivate();
			$this->_response = Redirect::to(URL::to($this->base_uri))->with('flash.success', 'Resource Deactivated');
		}

		$this->invoke_callback('after_activate');
		$this->invoke_callback('after_action');

		return $this->_response;
	}
}