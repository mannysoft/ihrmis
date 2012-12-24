<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_head_office extends CI_Migration {
	
	function up() 
	{					
		$data = array(
				'name' 				=> 'head_of_office',
				'setting_value' 	=> '',
				'settings_group'	=> 'payroll',
				'description'		=> 'Name of Governor, Mayor, Director',
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 				=> 'head_of_office_position',
				'setting_value' 	=> '',
				'settings_group'	=> 'payroll',
				'description'		=> 'Like Governor, Mayor, Director',
				);
		
		$this->db->insert('settings', $data);

	}

	function down() 
	{		
		return TRUE;
	}
}
