<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_allow_monetize_using_vl_sl extends CI_Migration {
	
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
				'name' 				=> 'allow_monetize_using_vl_sl',
				'setting_value' 	=> $allow,
				'settings_group'	=> 'leave',
				'description'		=> 'Allow Monetization deduction against both VL and SL.',
				);
		
		$this->db->insert('settings', $data);
		

	}

	function down() 
	{		
		$this->db->where('name', 'allow_monetize_using_vl_sl');
		$this->db->delete('settings');	
	}
}
