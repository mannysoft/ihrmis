<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_employee_add_columns extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "adding employee table columns...";
		
		$fields = array(
                        'assistant_dept_head' => array('type' => 'INT',
														'constraint' => '2',
														'null' => FALSE)
);
		$this->dbforge->add_column('employee', $fields, 'position');
		
	}

	function down() 
	{
		//$this->migrations->verbose AND print "dropping employee table columns...";
		
		$this->dbforge->drop_column('employee', 'assistant_dept_head');
		
		
	}
}
