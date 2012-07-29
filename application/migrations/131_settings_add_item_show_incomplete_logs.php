<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_show_incomplete_logs extends CI_Migration {
	
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
				'name' 				=> 'show_incomplete_logs',
				'setting_value' 	=> $allow,
				'settings_group'	=> 'attendance',
				'description'		=> 'Show incomplete logs in view attendance.',
				);
		
		$this->db->insert('settings', $data);
		

	}

	function down() 
	{		
		return TRUE;
	}
}
