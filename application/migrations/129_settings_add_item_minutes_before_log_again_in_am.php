<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_minutes_before_log_again_in_am extends CI_Migration {
	
	function up() 
	{					
		$data = array(
				'name' 				=> 'minutes_before_log_again_in_am',
				'setting_value' 	=> '5',
				'settings_group'	=> 'attendance',
				'description'		=> 'Minutes Before log again in AM.',
				);
		
		$this->db->insert('settings', $data);
		

	}

	function down() 
	{		
		return TRUE;
	}
}
