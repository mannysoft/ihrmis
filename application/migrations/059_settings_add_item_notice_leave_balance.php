<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_settings_add_item_notice_leave_balance extends CI_Migration {
	
	function up() 
	{	
		
		$data = array(
				'name' 			=> 'notice_leave_balance',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 			=> 'notice_leave_balance_position',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 			=> 'notice_leave_balance_noted',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);
		
		$data = array(
				'name' 			=> 'notice_leave_balance_noted_position',
				'setting_value' => ''
				);
		
		$this->db->insert('settings', $data);

	}

	function down() 
	{
		
		$this->db->where('name', 'hospital_view_leave_days');
		$this->db->delete('settings');
		
		//$this->db->where('name', 'cto_certification_position');
		//$this->db->delete('settings');
	
	}
}
