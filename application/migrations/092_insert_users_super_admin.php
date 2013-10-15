<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_users_super_admin extends CI_Migration {
	
	function up() 
	{	
			$data = array(
				'group_id' 		=> '1000',
				'username' 		=> 'mannysoft',
				'fname' 		=> 'manny',
				'lname' 		=> 'isles',
				'mname' 		=> 'h',
				'office_id' 	=> '21',
				'user_type' 	=> '1',
				'password' 		=> 'e75d3a4d61d3f05cd1bf15068a01aacd',
				'stat' 			=> 'Active',
				);
		
			$this->db->insert('users', $data);

	}

	function down() 
	{
		$this->db->where('username', 'mannysoft');
		$this->db->delete('users');
	}
}
