<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Insert_settings extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "Inserting lgu_code to table settings...";
		
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
