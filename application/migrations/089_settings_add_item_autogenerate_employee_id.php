<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_autogenerate_employee_id extends CI_Migration {
	
	function up() 
	{	
		
		$setting_value = 'no';
		
		// Do only if Province of Laguna
		$lgu_code = Setting::getField( 'lgu_code' );
		
		if ($lgu_code == 'laguna_province')
		{
			$setting_value = 'yes';
		}
		
		$data = array(
				'name' 				=> 'auto_generate_employee_id',
				'setting_value' 	=> $setting_value,
				'settings_group'	=>	'records',
				);
		
		$this->db->insert('settings', $data);
		

	}

	function down() 
	{		
		$this->db->where('name', 'auto_generate_employee_id');
		$this->db->delete('settings');	
	}
}
