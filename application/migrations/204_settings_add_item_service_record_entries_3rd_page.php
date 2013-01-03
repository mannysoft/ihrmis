<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_service_record_entries_3rd_page extends CI_Migration {
	
	function up() 
	{					
		$data = array(
				'name' 				=> 'service_record_entries_3rd_page',
				'setting_value' 	=> '12',
				'settings_group'	=> 'employee',
				'description'		=> 'The number of entries to be display in service record.',
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 				=> 'service_record_entries_4th_page',
				'setting_value' 	=> '15',
				'settings_group'	=> 'employee',
				'description'		=> 'The number of entries to be display in service record.',
				);
		
		$this->db->insert('settings', $data);
	}

	function down() 
	{		
		return TRUE;
	}
}
