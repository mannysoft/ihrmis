<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_show_leave_credits_leave_apps extends CI_Migration {
	
	function up() 
	{					
		// Do only if Puerto
		$lgu_code = $this->Settings->get_selected_field( 'lgu_code' );
		
		$allow = 'no';
		
		if ($lgu_code == '')
		{
			$allow = 'yes';
		}
		
		$data = array(
				'name' 				=> 'show_leave_credits_leave_apps',
				'setting_value' 	=> $allow,
				'settings_group'	=> 'leave',
				'description'		=> 'Show leave balance in leave application page.',
				);
		
		$this->db->insert('settings', $data);
	}

	function down() 
	{		
		return TRUE;
	}
}
