<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_hospital_view_leave_days extends CI_Migration {
	
	function up() 
	{	
		
		$data = array(
				'name' 			=> 'hospital_view_leave_days',
				'setting_value' => '0'
				);
		
		$this->db->insert('settings', $data);
		
		//$data = array(
				//'name' 			=> 'cto_certification_position',
				//'setting_value' => ''
				//);
		
		//$this->db->insert('settings', $data);

	}

	function down() 
	{
		
		$this->db->where('name', 'hospital_view_leave_days');
		$this->db->delete('settings');
		
		//$this->db->where('name', 'cto_certification_position');
		//$this->db->delete('settings');
	
	}
}
