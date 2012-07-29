<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item extends CI_Migration {
	
	function up() 
	{	
		
		$data = array(
				'name' 			=> 'cto_certification',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 			=> 'cto_certification_position',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);

	}

	function down() 
	{
		
		$this->db->where('name', 'cto_certification');
		$this->db->delete('settings');
		
		$this->db->where('name', 'cto_certification_position');
		$this->db->delete('settings');
	
	}
}
