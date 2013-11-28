<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_accept_late_ob extends CI_Migration {
	
	function up() 
	{							
		// Do only if Puerto
		$lgu_code = Setting::getField( 'lgu_code' );
		
		$accept_late_ob = 'yes';
		
		if ($lgu_code == 'marinduque_province')
		{
			$accept_late_ob = 'no';
		}
		
		$data = array(
				'name' 				=> 'accept_late_ob',
				'setting_value' 	=> $accept_late_ob,
				'settings_group'	=> 'attendance',
				'description'		=> 'whether to accept late filing of ob or itinerary',
				);
		
		$this->db->insert('settings', $data);
	}

	function down() 
	{		
		return TRUE;
	}
}
