<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_show_perform_leave_earnings_now extends CI_Migration {
	
	function up() 
	{			
		// Do only if Province of Laguna
		$lgu_code = $this->Settings->get_selected_field( 'lgu_code' );
		
		$allow = 'yes';
		
		if ($lgu_code == 'laguna_province')
		{
			$allow = 'no';
		}
		
		$data = array(
				'name' 				=> 'show_perform_leave_earnings_now',
				'setting_value' 	=> $allow,
				'settings_group'	=> 'leave',
				'description'		=> 'Tell whether the system display the perform leave earnings now link under nav menu.',
				);
		
		$this->db->insert('settings', $data);
		

	}

	function down() 
	{		
		$this->db->where('name', 'show_perform_leave_earnings_now');
		$this->db->delete('settings');	
	}
}
