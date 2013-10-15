<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_view_dtr_leave_time extends CI_Migration {
	
	function up() 
	{					
		$data = array(
				'name' 				=> 'view_dtr_leave_time',
				'setting_value' 	=> '10',
				'settings_group'	=> 'attendance',
				'description'		=> 'Seconds to close the DTR and leave inquiry.',
				);
		
		$this->db->insert('settings', $data);
		

	}

	function down() 
	{		
		return TRUE;
	}
}
