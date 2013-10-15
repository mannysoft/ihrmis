<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_usertype_view extends	CI_Migration {
	
	function up() 
	{	
		
		$data[] = array('id' => '8', 'name' => 'View Attendance 10 Times Tardy');
		
		foreach ( $data as $array)
		{
			$this->db->insert('user_type', $array);
		}
		foreach ( $data as $array)
		{
			$this->db->insert('user_group', $array);
		}
	}

	function down() 
	{
		$this->db->where('id', 8);
		$this->db->delete('user_type');
		$this->db->where('id', 8);
		$this->db->delete('user_group');
	}
}
