<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_employee_add_column_emergency_contact extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'emergency_contact' => array('type' => 'VARCHAR (32)', 'null' => FALSE, 'DEFAULT' => '')
);
		$this->dbforge->add_column('employee', $fields, 'date_retired');	
		
		$fields = array(
                        'emergency_contact_no' => array('type' => 'VARCHAR (32)', 'null' => FALSE, 'DEFAULT' => '')
);
		$this->dbforge->add_column('employee', $fields, 'emergency_contact');			
	}

	function down() 
	{		
		return TRUE;
	}
}
