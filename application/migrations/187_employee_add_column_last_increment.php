<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_employee_add_column_last_increment extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'last_increment' => array('type' => 'VARCHAR (32)', 'null' => FALSE, 'DEFAULT' => '')
);
		$this->dbforge->add_column('employee', $fields, 'last_promotion');			
	}

	function down() 
	{		
		return TRUE;
	}
}
