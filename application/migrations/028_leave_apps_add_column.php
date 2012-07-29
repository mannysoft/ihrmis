<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_leave_apps_add_column extends CI_Migration {
	
	function up() 
	{	
				
		$fields = array(
                        'allow_sat_sun' => array('type' => 'INT', 'null' => FALSE)
						);
						
		$this->dbforge->add_column('leave_apps', $fields, 'date_encode');		

	}

	function down() 
	{
		
		$this->dbforge->drop_column('leave_apps', 'allow_sat_sun');
		
	}
}
