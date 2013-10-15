<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_usergroup_leave extends	CI_Migration {
	
	function up() 
	{	
		
		$data[] = array('id' => '6', 'name' => 'Leave Administrator');
		
		foreach ( $data as $array)
		{
			$this->db->insert('user_group', $array);
		}
	}

	function down() 
	{
		$this->db->where('id', 6);
		$this->db->delete('user_group');
	}
}
