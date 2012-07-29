<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item extends CI_Migration {
	
	function up() 
	{	
		
		$data = array(
				'name' 			=> 'republic',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 			=> 'lgu_name',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 			=> 'lgu_office',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 			=> 'lgu_address',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);

	}

	function down() 
	{
		
		$this->db->where('name', 'republic');
		$this->db->delete('settings');
		
		$this->db->where('name', 'lgu_name');
		$this->db->delete('settings');
		
		$this->db->where('name', 'lgu_office');
		$this->db->delete('settings');
		
		$this->db->where('name', 'lgu_address');
		$this->db->delete('settings');
	}
}
