<?php

namespace Repository;

use Core\Artist\Model;

class Artists extends Base
{
	protected function includes() {
		return [
			'featured_songs' => function ($q) {
				$q->where_active(1);
			},
			'profile_photo'
		];
	}

	protected function q()
	{
		$q = Model::where(Model::$table.'.active', '=', 1)->select(Model::$table.'.*')->distinct();

		return $q;
	}

	protected function filtered_q()
	{
		$params = $this->_filter;
		$q = $this->q();

		if(array_key_exists('tags', $params))
			$q = $this->add_tag_constraints($q, (array) $params['tags']);

		if(array_key_exists('favorited_by_user', $params))
			$q = $this->add_favorited_by_user_constraint($q, $params['favorited_by_user']);

		$q = $q->order_by(Model::$table.'.rating', 'desc');

		return $q;
	}
	public function find_by_slug($slug)
	{
		return Model::where_slug($slug)->where_active(1)->first();
	}

	public function find_by_id($id)
	{
		return Model::where_active(1)->where_id($id)->first();
	}

	public function count()
	{
		$q = $this->filtered_q();
		$q = $q->select($q->model->table().'.id');
		return $q->count('id');
	}

	public function paginate($per_page = 20)
	{
		return $this->eager_load($this->filtered_q())->paginate($per_page);
	}
}