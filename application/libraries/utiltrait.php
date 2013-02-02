<?php

trait UtilTrait
{
	public function is_api_call($uri)
	{
		return starts_with($uri, 'api');
	}
}