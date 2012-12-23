<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_agency_accountant extends CI_Migration {
	
	function up() 
	{					
		$data = array(
				'name' 				=> 'agency_accountant',
				'setting_value' 	=> '',
				'settings_group'	=> 'payroll',
				'description'		=> 'The accountant that appear in payroll',
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 				=> 'agency_accountant_position',
				'setting_value' 	=> '',
				'settings_group'	=> 'payroll',
				'description'		=> 'The Position of the accountant that appear in payroll',
				);
		
		$this->db->insert('settings', $data);

	}

	function down() 
	{		
		return TRUE;
	}
}
