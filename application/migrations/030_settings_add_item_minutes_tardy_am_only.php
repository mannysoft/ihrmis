<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_minutes_tardy_am_only extends CI_Migration {
	
	function up() 
	{	
		
		$data = array(
				'name' 			=> 'minutes_tardy_am_only',
				'setting_value' => '0'
				);
		
		$this->db->insert('settings', $data);
		
	}

	function down() 
	{
		
		$this->db->where('name', 'minutes_tardy_am_only');
		$this->db->delete('settings');
	}
}
