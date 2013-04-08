<?php

class Core_Add_Artist_Video_Wight {
    protected $table = 'core_artist_video';
	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table($this->table, function ($t) {
            $t->integer('weight')->default(0)->unsigned();
        });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table($this->table, function ($t) {
            $t->drop_column('weight');
        });
	}

}