<?php

use Core\Artist\Model as Artist;


class Artistsignup_Controller extends App_Controller
{
	public $restful = true;

	public function get_index()
	{
		return View::make('artistsignup.index');
	}

	public function get_selection()
	{
		if(! Auth::check() )
			return Redirect::to('artistsignup/index');

		/** Get stuff for artists **/

		return View::make('artistsignup.selection');
	}

	public function post_selection()
	{
		if( ! Auth::check() )
			return Redirect::to('artistsignup/index');

		/**Check for the unique password stuff here**/
	}

	public function get_agreement()
	{
		if( ! Auth::check() )
			return Redirect::to('artistsignup/index');

		if( ! Session::has('flash.artist_id') )
			return Redirect::to('artistsignup/selection');

		if(! $artist = Artist::find(Session::get('flash.artist_id')) )
			return Response::error(404);

		return View::make('artistsignup.agreement');
	}

	public function post_agreement()
	{
		if(! Auth::check() )
			return Redirect::to('artistsignup/index');

		/**Do stuff to get artist agreement**/
	}
}