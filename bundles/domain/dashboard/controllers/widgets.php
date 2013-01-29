<?php

class Dashboard_Widgets_Controller extends Dashboard_Base_Controller {

	public function get_widget($slug)
	{
		if(! Request::ajax() )
			return Response::error(404);

		$params = [];
		parse_str(urldecode(Input::get('params')), $params);

		$args = [
			Input::get('uri'),
			Auth::user(),
			$params
		];

		if(! $widget = Dashboard::widget($slug, $args))
			return Response::make($slug, 400);

		return $widget;
	}

}