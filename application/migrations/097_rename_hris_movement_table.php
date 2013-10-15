<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_rename_hris_movement_table extends CI_Migration {
	
	function up() 
	{			
		// SO that we can find the table 'hris_employee_status'
		$this->db->set_dbprefix('hris_'); 
		
		if ( $this->db->table_exists('hris_movement'))
		{	
			$this->db->query('RENAME TABLE `hris_movement` TO `ats_employee_movements`'); 
		}
		
		// Return back to ats_ prefix to update the 'ats_migrations' table
		$this->db->set_dbprefix('ats_'); 
	}

	function down() 
	{		
		//$this->db->query('RENAME TABLE `hris_employee_status` TO `ats_employee_status`'); 
	}
}
