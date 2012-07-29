<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_salary_grade_add_columns extends CI_Migration {
	
	function up() 
	{	
				
		$fields = array(
                        'salary_grade_type' => array('type' => 'VARCHAR (16)', 'null' => FALSE)
						);
						
		$this->dbforge->add_column('salary_grade', $fields, 'year');		
		
	}

	function down() 
	{
		
		$this->dbforge->drop_column('salary_grade', 'salary_grade_type');
	}
}
