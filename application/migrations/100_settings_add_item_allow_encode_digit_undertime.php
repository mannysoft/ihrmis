<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_allow_encode_digit_undertime extends CI_Migration {
	
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
				'name' 				=> 'allow_encode_digit_undertime',
				'setting_value' 	=> $allow,
				'settings_group'	=> 'leave',
				'description'		=> 'Tell whether the system allow the encoding of undertime digits.',
				);
		
		$this->db->insert('settings', $data);
		

	}

	function down() 
	{		
		$this->db->where('name', 'allow_encode_digit_undertime');
		$this->db->delete('settings');	
	}
}
