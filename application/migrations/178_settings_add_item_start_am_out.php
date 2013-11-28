<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_start_am_out extends CI_Migration {
	
	function up() 
	{					
		$am_out = '';
		$pm_in = '';
		
		// Do only if bataraza
		$lgu_code = Setting::getField( 'lgu_code' );
				
		if ($lgu_code == 'bataraza')
		{
			$am_out = '12:20';
			$pm_in = '12:45';
		}
		
		$data = array(
				'name' 				=> 'end_am_out',
				'setting_value' 	=> $am_out,
				'settings_group'	=> 'attendance',
				'description'		=> 'End am out.',
				);
		
		$this->db->insert('settings', $data);
		$data = array(
				'name' 				=> 'start_pm_in',
				'setting_value' 	=> $pm_in,
				'settings_group'	=> 'attendance',
				'description'		=> 'start pm in.',
				);
		
		$this->db->insert('settings', $data);

	}

	function down() 
	{		
		return TRUE;
	}
}
