<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_last_name_first_dtr extends CI_Migration {
	
	function up() 
	{	
		
		$setting_value = 'no';
		
		// Do only if Province of Laguna
		$lgu_code = Setting::getField( 'lgu_code' );
		
		if ($lgu_code == 'quezon_province')
		{
			$setting_value = 'yes';
		}
		
		$data = array(
				'name' 				=> 'last_name_first_dtr',
				'setting_value' 	=> $setting_value,
				'settings_group'	=>	'attendance',
				);
		
		$this->db->insert('settings', $data);
		

	}

	function down() 
	{		
		$this->db->where('name', 'last_name_first_dtr');
		$this->db->delete('settings');	
	}
}
