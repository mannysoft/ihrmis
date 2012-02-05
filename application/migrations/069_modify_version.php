<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_version extends CI_Migration {
	
	function up() 
	{	
		$this->db->where('name', 'version');
		$this->db->update('settings', array('setting_value' => '2.0.0' ));		
	}

	function down() 
	{
		$this->db->where('name', 'version');
		$this->db->update('settings', array('setting_value' => '1.76' ));		
	}
}
