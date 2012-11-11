<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_leave_type_insert_mc_22012 extends CI_Migration {
	
	function up() 
	{	
		$data = array('code' => 'CSC MC. No.2 s.2012', 'leave_name' => 'Spec. Emer. Leave MC2 s.2012');
		$this->db->insert('leave_type', $data);		
	}

	function down() 
	{
		return TRUE;
	}
}
