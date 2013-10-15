<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_users_update_column_group_id extends CI_Migration {
	
	function up() 
	{			
		$agency = $this->Settings->get_selected_field( 'system_name' );
		
		if ($agency == 'Provincial Government of Quezon')
		{
			$this->db->where('group_id', 0);
			$this->db->update('users', array('group_id' => 1));
		}
	}

	function down() 
	{		
		return TRUE;
	}
}
