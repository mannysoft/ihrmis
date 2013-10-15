<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_delete_system_generated_forced_leave extends CI_Migration {
	
	
	function up() 
	{	
		$this->db->where('leave_type_id', 7);
		$this->db->where('forced_leave_system_generated','yes');
		$this->db->delete('leave_card');

	}

	function down() 
	{
	
	}
}
