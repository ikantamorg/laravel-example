<?php

namespace Repository;

use Str;

abstract class Base
{
	public function add_constraints($q, $constraints)
	{
		foreach($constraints as $k => $c) {
			if(is_int($k))
			{
				list($field, $operator, $value) = $c;
				$q = $q->where($field, $operator, $constraints);
			}
			elseif(in_array($k, ['where', 'or_where']))
			{
				list($field, $operator, $value) = $c;
				$q = $q->$k($field, $operator, $value);
			}
			elseif(in_array($k, ['where_in', 'where_not_in', 'or_where_in', 'or_where_not_in']))
			{
				list($field, $value) = $c;
				if( $value = (array) $value )
					$q = $q->$k($field, $value);
			}
		}

		return $q;
	}

	public function add_tag_constraints($q, $constraints);
	{
		if(! $slug = $q->model->tagable_slug )
			return;

		$singular = Str::singular($slug);

		$junction = 'core_tag_'.$singular;

		$q = $q->join($junction, $junction.".{$singular}_id", '=', $q->model->table().'.id')
			   ->join('core_tags', $junction.'.tag_id', '=', 'core_tags.id');

		

		return $q;
	}
}