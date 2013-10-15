<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Insert_settings_statement_prepared extends CI_Migration {
	
	function up() 
	{	
		
		$data = array(
				'name' 			=> 'statement_prepared',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 			=> 'statement_prepared_position',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 			=> 'statement_certified',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 			=> 'statement_certified_position',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);

	}

	function down() 
	{
		$this->db->where('name', 'statement_prepared');
		$this->db->delete('settings');
		
		$this->db->where('name', 'statement_prepared_position');
		$this->db->delete('settings');
		
		$this->db->where('name', 'statement_certified');
		$this->db->delete('settings');
		
		$this->db->where('name', 'statement_certified_position');
		$this->db->delete('settings');
	}
}
