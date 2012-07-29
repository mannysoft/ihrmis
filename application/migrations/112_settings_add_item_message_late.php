<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_message_late extends CI_Migration {
	
	function up() 
	{			
		
		$data = array(
				'name' 				=> 'message_late',
				'setting_value' 	=> 'yes',
				'settings_group'	=> 'attendance',
				'description'		=> 'Set if we want to tell the employee that he is late.',
				);
		
		$this->db->insert('settings', $data);
		

	}

	function down() 
	{		
		$this->db->where('name', 'message_late');
		$this->db->delete('settings');	
	}
}
