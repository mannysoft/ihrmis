<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_salary_grade_add_columns_salary_grade_type extends CI_Migration {
	
	function up() 
	{	
		
		
		$field = array('salary_grade_type' => array('type' => 'VARCHAR (16)', 'null' =>false));	
		
		$this->dbforge->add_column('salary_grade', $field, 'year');
		
	}

	function down() 
	{
		
		$this->dbforge->drop_column('salary_grade', 'salary_grade_type');
	}
}
