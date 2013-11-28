<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_enable_add_earn_menu extends CI_Migration {
	
	function up() 
	{					
		// Do only if Puerto
		$lgu_code = Setting::getField( 'lgu_code' );
		
		$allow = 'no';
		
		if ($lgu_code == '')
		{
			$allow = 'yes';
		}
		
		$data = array(
				'name' 				=> 'enable_add_earn_menu',
				'setting_value' 	=> 'no',
				'settings_group'	=> 'leave',
				'description'		=> 'Show add earn menu.',
				);
		
		$this->db->insert('settings', $data);
	}

	function down() 
	{		
		return TRUE;
	}
}
