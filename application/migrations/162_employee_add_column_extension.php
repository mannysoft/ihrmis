<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_employee_add_column_extension extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'extension' => array('type' => 'VARCHAR (32)', 'null' => FALSE, 'DEFAULT' => '')
);
		$this->dbforge->add_column('employee', $fields, 'mname');		
	}

	function down() 
	{		
		return TRUE;
	}
}
