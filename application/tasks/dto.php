<?php

Bundle::start('core');

use Util\DateTimeOptions as DTO;

class Dto_Task
{
	public function run()
	{
		var_dump(DTO::times());
	}

	public function stuff()
	{
		$a = Core\Artist\Model::with([
				'events' => [
					'aggregate' => function ($q) { $q->take(2)->select($q->column('id')); }
				]
			])->where_name('Kohra')->first();

		echo $a->name . "\n" . "\n";

		foreach($a->events as $e)
		{
			echo "    " . $e->id . "\n";
		}
	}

	public function has_many()
	{
		$t = Core\Artist\Type::with([
			'artists' => [
				'where' => function ($q) {
					$q->where('name', 'like', '%e%');
				},
				'aggregate' => function ($q) {
					$q->order_by($q->column('name'), 'desc');
				}
			]
		])->first();

		echo $t->name . "\n" . "\n";

		foreach($t->artists as $a)
		{
			echo "    " . $a->name . "\n";
		}
	}
}