<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_delete_leave_card_zeros extends CI_Migration {
	
	function up() 
	{	
		$this->db->where('date', '0000-00-00');
		$this->db->delete('leave_card');
	}

	function down() 
	{
		
	}
}
