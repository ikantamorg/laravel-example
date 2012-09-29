<?php

namespace Uploader\Handler;

class Audio extends Base
{
	public function process_uploaded_file()
	{
		return [$this->move_uploaded_file()];
	}
}