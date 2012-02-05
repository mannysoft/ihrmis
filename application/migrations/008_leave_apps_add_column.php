<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_leave_apps_add_column extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "adding column 'office_id' to leave_apps table";
		
		$fields = array(
                        'office_id' => array('type' => 'INT', 'null' => FALSE)
						);
						
		$this->dbforge->add_column('leave_apps', $fields, 'employee_id');

	}

	function down() 
	{
		
		//$this->migrations->verbose AND print "dropping column 'office_id' from leave_apps table";
		
		$this->dbforge->drop_column('leave_apps', 'office_id');
	}
}
