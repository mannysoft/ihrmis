<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "Inserting service record signatories to table settings...";
		
		$data = array(
				'name' 			=> 'sr_prepared',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 			=> 'sr_prepared_position',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 			=> 'sr_certified',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 			=> 'sr_certified_position',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);

	}

	function down() 
	{
		//$this->migrations->verbose AND print "deleting service record signatories from table settings...";
		
		$this->db->where('name', 'sr_prepared');
		$this->db->delete('settings');
		
		$this->db->where('name', 'sr_prepared_position');
		$this->db->delete('settings');
		
		$this->db->where('name', 'sr_certified');
		$this->db->delete('settings');
		
		$this->db->where('name', 'sr_certified_position');
		$this->db->delete('settings');
	}
}
