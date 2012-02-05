<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_office_add_columns extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "adding salary_grade_type table columns...";
		
		$fields = array(
                        'salary_grade_type' => array('type' => 'VARCHAR (32)', 'null' => FALSE)
);
		$this->dbforge->add_column('office', $fields, 'office_address');
		
	}

	function down() 
	{
		//$this->migrations->verbose AND print "dropping office table columns...";
		
		$this->dbforge->drop_column('office', 'salary_grade_type');
		
		
	}
}
