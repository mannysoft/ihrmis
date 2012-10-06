<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_employee_add_column_orig_id extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'orig_id' => array('type' => 'VARCHAR (32)', 'null' => FALSE, 'DEFAULT' => '')
);
		$this->dbforge->add_column('employee', $fields, 'updated');		
	}

	function down() 
	{		
		return TRUE;
	}
}
