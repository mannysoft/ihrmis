<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_allow_45mins extends CI_Migration {
	
	function up() 
	{					
		$data = array(
				'name' 				=> 'allow_45mins',
				'setting_value' 	=> 'no',
				'settings_group'	=> 'attendance',
				'description'		=> 'allow 12:45 PM IN',
				);
		
		$this->db->insert('settings', $data);
		

	}

	function down() 
	{		
		return TRUE;
	}
}
