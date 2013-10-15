<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_office_add_columns_salary_grade_type extends CI_Migration {
	
	function up() 
	{	
		
		$fields = array(
                        'salary_grade_type' => array('type' => 'VARCHAR (32)', 'null' => FALSE)
);
		$this->dbforge->add_column('office', $fields, 'office_address');
		
	}

	function down() 
	{
		
		$this->dbforge->drop_column('office', 'salary_grade_type');
		
		
	}
}
