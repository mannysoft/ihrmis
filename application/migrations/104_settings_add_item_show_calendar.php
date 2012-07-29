<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_show_calendar extends CI_Migration {
	
	function up() 
	{			
		// Do only if Province of Laguna
		$lgu_code = $this->Settings->get_selected_field( 'lgu_code' );
		
		$allow = 'no';
		
		if ($lgu_code == 'laguna_province')
		{
			$allow = 'yes';
		}
		
		$data = array(
				'name' 				=> 'show_calendar',
				'setting_value' 	=> $allow,
				'settings_group'	=> 'leave',
				'description'		=> 'Show the calendar in file leave',
				);
		
		$this->db->insert('settings', $data);
		

	}

	function down() 
	{		
		$this->db->where('name', 'show_calendar');
		$this->db->delete('settings');	
	}
}
