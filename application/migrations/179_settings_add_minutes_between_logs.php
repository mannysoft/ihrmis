<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_minutes_between_logs extends CI_Migration {
	
	function up() 
	{					
		$minutes_between_logs = '';
		
		// Do only if bataraza
		$lgu_code = Setting::getField( 'lgu_code' );
				
		if ($lgu_code == 'bataraza')
		{
			$minutes_between_logs = '5';
		}
		
		$data = array(
				'name' 				=> 'minutes_between_logs',
				'setting_value' 	=> $minutes_between_logs,
				'settings_group'	=> 'attendance',
				'description'		=> 'minutes between every logs.',
				);
		
		$this->db->insert('settings', $data);
	}

	function down() 
	{		
		return TRUE;
	}
}
