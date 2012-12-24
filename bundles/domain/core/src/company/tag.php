<?php

namespace Core\Company;

use Core\Abstracts;

class Tag extends Abstracts\Model
{
	public static $table = 'core_company_tags';

	public static $accessible = [];

	public function companies()
	{
		return $this->has_many_and_belongs_to('Core\\Company\\Tag', 'core_company_company_tag', 'tag_id', 'company_id');
	}
}