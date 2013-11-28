<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_auto_deduct_mc_vl extends CI_Migration {
	
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
				'name' 				=> 'auto_deduct_mc_vl',
				'setting_value' 	=> $allow,
				'settings_group'	=> 'leave',
				'description'		=> 'MC is 3 days only. Excess must be automatically deducted to VL/SL.',
				);
		
		$this->db->insert('settings', $data);
		

	}

	function down() 
	{		
		$this->db->where('name', 'auto_deduct_mc_vl');
		$this->db->delete('settings');	
	}
}
