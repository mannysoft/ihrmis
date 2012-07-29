<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_employee_add_column_employee_movement_id extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'employee_movement_id' => array('type' => 'INT (4)', 'null' => FALSE, 'DEFAULT' => 1)
);
		$this->dbforge->add_column('employee', $fields, 'permanent');		
	}

	function down() 
	{		
		$this->dbforge->drop_column('employee', 'division_id');
	}
}
