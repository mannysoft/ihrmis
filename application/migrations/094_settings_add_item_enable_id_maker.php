<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_enable_id_maker extends CI_Migration {
	
	function up() 
	{			
		$data = array(
				'name' 				=> 'enable_id_maker',
				'setting_value' 	=> 'yes',
				'settings_group'	=> 'records',
				);
		
		$this->db->insert('settings', $data);
		

	}

	function down() 
	{		
		$this->db->where('name', 'enable_id_maker');
		$this->db->delete('settings');	
	}
}
