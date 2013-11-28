<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_auto_seven_days extends CI_Migration {
	
	function up() 
	{			
		// Do only if Province of Laguna
		$lgu_code = Setting::getField( 'lgu_code' );
		
		$allow = 'no';
		
		if ($lgu_code == 'laguna_province')
		{
			$allow = 'yes';
		}
		
		$data = array(
				'name' 				=> 'auto_seven_days',
				'setting_value' 	=> $allow,
				'settings_group'	=> 'leave',
				'description'		=> 'Set 7 days if paternity leave.',
				);
		
		$this->db->insert('settings', $data);
		

	}

	function down() 
	{		
		$this->db->where('name', 'auto_seven_days');
		$this->db->delete('settings');	
	}
}
