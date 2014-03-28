<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_service_record_paper_size extends CI_Migration {
	
	function up() 
	{	
		
		$setting_value = 'Letter';
		
		// Do only if Province of Laguna
		$lgu_code = Setting::getField( 'lgu_code' );
		
		if ($lgu_code == 'marinduque_province')
		{
			$setting_value = 'Legal';
		}
		
		$data = array(
				'name' 				=> 'service_record_paper_size',
				'setting_value' 	=> $setting_value,
				'settings_group'	=>	'employees',
				);
		
		$this->db->insert('settings', $data);
		

	}

	function down() 
	{		
		$this->db->where('name', 'last_name_first_dtr');
		$this->db->delete('settings');	
	}
}
