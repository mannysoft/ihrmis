<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_sessions extends CI_Migration {
	
	function up() 
	{	
		$this->db->query('CREATE INDEX last_activity_idx ON ats_sessions(last_activity)');
		$this->db->query('ALTER TABLE ats_sessions MODIFY user_agent VARCHAR(120)');
		//$this->db->update('settings', array('setting_value' => '2.0.0' ));		
	}

	function down() 
	{
		//$this->db->where('name', 'version');
		//$this->db->update('settings', array('setting_value' => '1.76' ));		
	}
}
