<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_training_prepared extends CI_Migration {
	
	function up() 
	{	
		
		$data = array(
				'name' 			=> 'training_prepared',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 			=> 'training_prepared_position',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 			=> 'training_certified',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 			=> 'training_certified_position',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);

	}

	function down() 
	{
		
		$this->db->where('name', 'training_prepared');
		$this->db->delete('settings');
		
		$this->db->where('name', 'training_prepared_position');
		$this->db->delete('settings');
		
		$this->db->where('name', 'training_certified');
		$this->db->delete('settings');
		
		$this->db->where('name', 'training_certified_position');
		$this->db->delete('settings');
	}
}
