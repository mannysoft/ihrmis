<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_final_approval_leave_application extends CI_Migration {
	
	function up() 
	{					
		$data = array(
				'name' 				=> 'final_approval_leave_application',
				'setting_value' 	=> '',
				'settings_group'	=> 'signatories',
				'description'		=> 'Final Signatory in leave application.',
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 				=> 'final_approval_leave_application_designation',
				'setting_value' 	=> '',
				'settings_group'	=> 'signatories',
				'description'		=> 'Final Signatory in leave application designation.',
				);
		
		$this->db->insert('settings', $data);
	}

	function down() 
	{		
		return TRUE;
	}
}
