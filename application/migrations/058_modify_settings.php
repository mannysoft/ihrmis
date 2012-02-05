<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_settings extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "Inserting hospital_view_leave_days to table settings...";
		
		$fields = array(
                        'name' => array(
                                                         'name' => 'name',
                                                         'type' => 'VARCHAR( 64 ) NOT NULL',
                                                ),
					);
					
			$this->dbforge->modify_column('settings', $fields);

	}

	function down() 
	{
		//$this->migrations->verbose AND print "deleting hospital_view_leave_days from table settings...";
	}
}
