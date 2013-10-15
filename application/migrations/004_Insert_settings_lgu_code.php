<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Insert_settings_lgu_code extends CI_Migration {
	
	function up() 
	{	
		
		$data = array(
				'name' 			=> 'lgu_code',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);
		


	}

	function down() 
	{
		$this->db->where('name', 'lgu_code');
		$this->db->delete('settings');
	}
}
