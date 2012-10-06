<?php

use Core\Media\Video;
use Core\IndustryPlayer\RegisterEntry as IndustryRegisterEntry;
use Core\Artist\Model as Artist;
use Core\Event\Model as Event;
use Core\Classification\Genre as Genre;

class Admin_Media_Videos_Controller extends Crud_Base_Controller
{
	public $fields = ['name', 'duration', 'youtube_id', 'youtube_url', 'provider', 'owner_id'];
	public $relations = ['events', 'artists', 'genres', 'type'];
	public $view_base = 'admin::media.videos.';
	public $base_uri = 'admin/media/videos/';

	/**Youtube Data Fetcher**/

	protected function youtube_api_url($v_id)
	{
		return 'http://gdata.youtube.com/feeds/api/videos/'.$v_id.'?v=2&alt=jsonc';
	}

	protected function make_curl($url)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$res = curl_exec($ch);
		curl_close($ch);

		return $res;
	}

	protected function extract_video_id($youtube_url)
	{
		$regex = '/v=([^&]+)/';
		preg_match($regex, $youtube_url, $matches);

		return $matches[1];
	}

	public function post_youtube_data()
	{
		Config::set('application.profiler', false);
		if( ! Request::ajax() )
			return Response::error(404);
		
		$data = $this->make_curl($this->youtube_api_url($this->extract_video_id(Input::get('youtube_url'))));

		$headers['Content-Type'] = 'application/json; charset=utf-8';
		return Response::make($data, 200, $headers);
	}

	/************************/

	public function resource($id = null)
	{
		if($this->_resource)
			return $this->_resource;

		return $this->_resource = $id === null ? new Video : Video::with(['artists', 'events', 'genres'])->find($id);
	}

	public function listing()
	{
		if($this->_listing)
			return $this->_listing;

		return $this->_listing = Video::with(['genres', 'industry_register_entry'])->get();
	}



	public function form()
	{
		$form = Hybrid\Form::make(function ($f) {
			$f->fieldset('Video', function ($fs) {
				$fs->control('text', 'Youtube URL', function ($c) {
					$c->name = 'youtube_url';
					$c->value = Input::old('youtube_url', @$this->resource()->youtube_url);
				});
				
				$fs->control('text', 'Name', function ($c) {
					$c->name = 'name';
					$c->value = Input::old('name', @$this->resource()->name);
				});

				$fs->control('select', 'Owner', function ($c) {
					$c->name = 'owner_id';
					$options = [0 => 'None'];
					foreach(IndustryRegisterEntry::all() as $ir)
						$options[$ir->type][$ir->id] = $ir->name;
					$c->options = $options;
					$c->value = Input::old('owner_id', @$this->resource()->owner_id);
				});

				$fs->control('select', 'Artists', function ($c) {
					$c->name = 'artists[]';
					$c->attr = ['multiple' => 'multiple'];
					$options = [];
					foreach(Artist::all() as $a)
						$options[$a->id] = $a->name;
					$c->options = $options;
					$c->value = Input::old('artists', array_map(function ($a) { return $a->id; }, (array) @$this->resource()->artists));
				});

				$fs->control('select', 'genres', function ($c) {
					$c->name = 'genres[]';
					$c->attr = ['multiple' => 'multiple'];
					$options = [];
					foreach(Genre::all() as $g)
						$options[$g->id] = $g->name;
					$c->options = $options;
					$c->value = Input::old('genres', array_map(function ($g) { return $g->id; }, (array) @$this->resource()->genres));
				});

				$fs->control('select', 'Events', function ($c) {
					$c->name = 'events[]';
					$c->attr = ['multiple' => 'multiple'];
					$options = [];
					foreach(Event::all() as $e)
						$options[$e->id] = $e->name;
					$c->options = $options;
					$c->value = Input::old('events', array_map(function ($e) { return $e->id; }, (array) @$this->resource()->events));
				});

				$fs->control('select', 'Type', function ($c) {
					$c->name = 'type';
					$options = [];
					foreach(Video\Type::all() as $t)
						$options[$t->id] = $t->name;
					$c->options = $options;
					$c->value = Input::old('type', @$this->resource()->type_id);
				});

				$fs->control('input:hidden', '', function ($c) {
					$c->name = 'provider';
					$c->value = 'youtube';
				});

				foreach(['duration', 'youtube_id', 'thumb'] as $field) {
					$fs->control('input:hidden', '', function ($c) use ($field) {
						$c->name = $field;
						$c->value = Input::old($field, @$this->resource()->{$field});
					});
				}
			});
		});

		return $form;
	}

	public function listing_table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->column('id');
			$t->column('name');
			$t->column('duration', function ($c) {
				$c->value = function ($r) {
					return @$r->duration . ' seconds';
				};
			});

			$t->column('owner', function ($c) {
				$c->value = function ($r) {
					return @$r->owner->name;
				};
			});

			$t->column('genres', function ($c) {
				$c->value = function ($r) {
					return implode(', ', array_map(function ($g) { return $g->name; }, (array) @$r->genres));
				};
			});

			$t->column('artists', function ($c) {
				$c->value = function ($r) {
					return implode(', ', array_map(function ($a) { return $a->name; }, (array) @$r->artists));
				};
			});

			$t->column('type', function ($c) {
				$c->value = function ($r) {
					return @$r->type->name;
				};
			});

			$t->column('', function ($c) {
				$c->value = function ($r) {
					return HTML::link(URl::to($this->base_uri.'show/'.$r->id), 'Show');
				};
			});

			$t->rows($this->listing());
		});

		return $table;
	}

	public function show_table()
	{
		$table = Hybrid\Table::make(function ($t) {
			$t->column('id');
			$t->column('name');
			$t->column('Video', function ($c) {
				$c->value = function ($r) {
					$attrs = [
						'src' => $r->embedded_player_url,
						'width' => '350px',
						'height' => '220px',
					];

					return $r->get_embedded_player($attrs);
				};
			});

			$t->rows([$this->resource()]);
		});

		return $table;
	}

	public function before_show()
	{
		
	}
}