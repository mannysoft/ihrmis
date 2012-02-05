<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_salary_grade_add_columns extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "adding salary_grade table columns...";
		
		$fields = array(
                        'salary_grade_type' => array('type' => 'VARCHAR (16) NOT NULL AFTER year')
);
		$this->dbforge->add_column('salary_grade', $fields);
		
	}

	function down() 
	{
		//$this->migrations->verbose AND print "dropping salary_grade table columns...";
		
		$this->dbforge->drop_column('salary_grade', 'salary_grade_type');
	}
}
