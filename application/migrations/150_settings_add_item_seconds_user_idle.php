<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_seconds_user_idle extends CI_Migration {
	
	function up() 
	{							
		// Do only if Puerto
		$lgu_code = $this->Settings->get_selected_field( 'lgu_code' );
		
		$seconds_user_idle = '7200';
		
		if ($lgu_code == '')
		{
			$seconds_user_idle = '0';
		}
		
		$data = array(
				'name' 				=> 'seconds_user_idle',
				'setting_value' 	=> $seconds_user_idle,
				'settings_group'	=> 'users',
				'description'		=> 'Seconds before logout if user is idle',
				);
		
		$this->db->insert('settings', $data);
	}

	function down() 
	{		
		return TRUE;
	}
}
