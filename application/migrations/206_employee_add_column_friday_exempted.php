<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_employee_add_column_friday_exempted extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'friday_exempted' => array('type' => 'ENUM("yes","no")', 'null' => FALSE, 'DEFAULT' => 'no')
);
		$this->dbforge->add_column('employee', $fields, 'shift_type');			
	}

	function down() 
	{		
		return TRUE;
	}
}
