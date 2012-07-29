<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_autodeduct extends CI_Migration {
	
	function up() 
	{	
		
		$data = array(
				'name' 			=> 'tardy_autodeduct',
				'setting_value' => 'yes'
				);
		
		$this->db->insert('settings', $data);
		

	}

	function down() 
	{		
		$this->db->where('name', 'tardy_autodeduct');
		$this->db->delete('settings');	
	}
}
