<?php

namespace Repository;

use Str;

abstract class Base
{
	public function add_tag_constraints($q, $tags)
	{
		if( ! $tags )
			return $q;

		if(! $tagable = $q->model->tagable )
			return $q;

		$singular = Str::singular($tagable->slug);

		$junction = 'core_tag_'.$singular;

		$q = $q->join($junction, $junction.".{$singular}_id", '=', $q->model->table().'.id')
			   ->join('core_tags', $junction.'.tag_id', '=', 'core_tags.id')
			   ->where_in('core_tags.slug', $tags);
		
		return $q;
	}
}