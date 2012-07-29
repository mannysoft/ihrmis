<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_usertype extends	CI_Migration {
	
	function up() 
	{	
		
		$data[] = array('id' => '6', 'name' => 'Leave Administrator');
		
		foreach ( $data as $array)
		{
			$this->db->insert('user_type', $array);
		}
	}

	function down() 
	{
		$this->db->where('id', 6);
		$this->db->delete('user_type');
	}
}
