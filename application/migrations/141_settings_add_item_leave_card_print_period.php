<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_leave_card_print_period extends CI_Migration {
	
	function up() 
	{							
		$data = array(
				'name' 				=> 'leave_card_print_period_from',
				'setting_value' 	=> '',
				'settings_group'	=> 'leave',
				'description'		=> 'Show data in leave card with range of date',
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 				=> 'leave_card_print_period_to',
				'setting_value' 	=> '',
				'settings_group'	=> 'leave',
				'description'		=> 'Show data in leave card with range of date',
				);
		$this->db->insert('settings', $data);

	}

	function down() 
	{		
		return TRUE;
	}
}
