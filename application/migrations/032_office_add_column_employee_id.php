<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_office_add_column_employee_id extends CI_Migration {
	
	function up() 
	{	
		
		$field = array('employee_id' => array('type' => 'VARCHAR (16)', 'null' =>false));	
		
		$this->dbforge->add_column('office', $field, 'office_head');

	}

	function down() 
	{
		
		$this->dbforge->drop_column('office', 'employee_id');
		
	}
}
