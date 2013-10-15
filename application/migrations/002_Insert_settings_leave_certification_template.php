<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Insert_settings_leave_certification_template extends CI_Migration {
	
	function up() 
	{	
		
		$data = array(
				'name' 			=> 'leave_certification_template',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);
		


	}

	function down() 
	{
		$this->db->where('name', 'leave_certification_template');
		$this->db->delete('settings');
	}
}
