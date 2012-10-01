<?php

namespace ArtistSignup;

use App_Controller;
use View;
use Auth;
use Session;
use Validator;
use Config;
use Input;
use DB;
use DateTime;
use Redirect;
use Core\Artist\Model as Artist;

class Controller extends App_Controller
{
	public $restful = true;

	protected $base_uri = 'artistsignup/';
	protected $view_base = 'artistsignup::pages.';

	public function before()
	{
		Session::put('artistsignup.running', true);
		App::setup();
		Config::set('application.profiler', false);
	}

	public function get_index()
	{
		if( Auth::check() )
			return Redirect::to($this->base_uri.'selection');

		return View::make($this->view_base.'index');
	}

	public function get_selection()
	{
		if(! Auth::check() )
			return Response::error(404);

		$agreed_artist_ids = array_map(function ($r) { return $r->artist_id; }, $this->q()->get());
		$relevant_artists = $agreed_artist_ids ? Artist::where_not_in('id', $areed_artist_ids)->get() : Artist::get();

		$artist_options = [];
		foreach($relevant_artists as $a)
			$artist_options[$a->id] = $a->name;

		return View::make($this->view_base.'selection')->with([
					'artist_options' => $artist_options
				]);
	}

	public function post_selection()
	{
		if(! Auth::check() )
			return Response::error(404);

		if($errors = $this->selection_validation(Input::get()))
			return Redirect::to($this->base_uri.'selection')->with_errors($errors);
		else{
			Session::put('artist_id', Input::get('artist_id'));
			return Redirect::to($this->base_uri.'agreement');
		}
	}

	public function get_agreement()
	{
		if(! Auth::check() or ! $artist = Artist::find(Session::get('artist_id')))
			return Response::error(404);

		return View::make($this->view_base.'agreement');
	}

	public function post_agreement()
	{
		if(! Auth::check or ! $artist = Artist::find(Session::get('artist_id')))
			return Response::error(404);

		if(Config::get('artistsignup::settings.flags.confirmation') !== Input::get('confirmation'))
			return Response::error(404);

		$this->make_artist_selected($artist);

		$msg = 'You have ACCEPTED the agreement for artist "'. $artist->name .'". Thank you !!! :)';

		Session::flash('artistsignup.finished', true);
		Session::flash('artistsignup.message', $msg);

		return Redirect::to($this->base_uri.'finished');
	}

	public function delete_agreement()
	{
		if(! Auth::check() or ! $artist = Artist::find(Session::get('artist_id')))
			return Response::error(404);

		if(Config::get('artistsignup::settings.flags.confirmation') !== Input::get('confirmation'))
			return Response::error(404);

		$msg = 'You have NOT ACCEPTED the agreement for artist "'. $artist->name .'". Thank you for considering it :)';

		Session::flash('atistsugnup.finished', true);
		Session::flash('artistsignup.message', $msg);

		return Redirect::to($this->base_uri.'finished');
	}

	public function get_finished()
	{
		if(! Session::get('artistsignup.finished') or ! Session::get('artistsignup.message'))
			return Response::error(404);

		Auth::logout();
		Session::forget('oneauth');
		Session::forget('artist_id');

		Session::put('artistsignup.running', true);

		return View::make($this->view_base . 'finished');
	}


	/**DOMAIN QUERY**/
	protected function q()
	{
		return DB::table(Config::get('artistsignup::settings.database.table'));
	}

	/**DOMAIN LOGIC**/

	protected function make_artist_selected($artist)
	{
		$this->q()->insert(['artist_id' => $artist->id, 'created_at' => new DateTime, 'updated_at' => new DateTime]);
	}

	protected function selection_validation($data)
	{
		$data['secret_password'] = Config::get('artistsignup::settings.security.password');

		$rules = [
			'artist_id' => 'required|'
						  .'exists:'.(new Artist)->table().',id|'
						  .'unique:'.Config::get('artistsignup::settings.database.table').',artist_id',
			'password' => 'required|same:secret_password'
		];

		$val = Validator::make($data, $rules);

		if($val->fails())
			return $val->errors;
		else
			return null;
	}
}