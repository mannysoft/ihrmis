<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_leave_apps_add_column_allow_sat_sun extends CI_Migration {
	
	function up() 
	{	
		
		$field = array('allow_sat_sun' => array('type' => 'INT', 'null' =>false));	
		
		$this->dbforge->add_column('leave_apps', $field, 'date_encode');

	}

	function down() 
	{
		
		$this->dbforge->drop_column('leave_apps', 'allow_sat_sun');
		
	}
}
