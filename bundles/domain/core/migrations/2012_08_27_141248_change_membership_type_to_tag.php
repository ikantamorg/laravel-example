<?php

class Core_Change_Membership_Type_To_Tag {

	protected function pdo()
	{
		return DB::connection()->pdo;
	}

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		$this->pdo()->query('rename table core_industry_membership_types to core_industry_membership_tags');
		$this->pdo()->query('rename table core_industry_membership_membership_type to core_industry_membership_membership_tag');

		$this->pdo()->query('alter table core_industry_membership_membership_tag 
							 change membership_type_id membership_tag_id INT(11)');
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		$this->pdo()->query('rename table core_industry_membership_tags to core_industry_membership_types');
		$this->pdo()->query('rename table core_industry_membership_membership_tag to core_industry_membership_membership_type');

		$this->pdo()->query('alter table core_industry_membership_membership_type 
							 change membership_tag_id membership_type_id INT(11)');
	}

}