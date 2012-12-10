<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_show_employee_number_dtr extends CI_Migration {
	
	function up() 
	{					
		$data = array(
				'name' 				=> 'show_employee_number_dtr',
				'setting_value' 	=> 'no',
				'settings_group'	=> 'attendance',
				'description'		=> 'Show the employee number in the printable DTR.',
				);
		
		$this->db->insert('settings', $data);

	}

	function down() 
	{		
		return TRUE;
	}
}
