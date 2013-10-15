<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_leave_apps_add_column_office_id extends CI_Migration {
	
	function up() 
	{	
		
		$fields = array(
                        'office_id' => array('type' => 'INT', 'null' => FALSE)
						);
						
		$this->dbforge->add_column('leave_apps', $fields, 'employee_id');

	}

	function down() 
	{
		
		
		$this->dbforge->drop_column('leave_apps', 'office_id');
	}
}
