<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_leave_card_modify_period extends CI_Migration {
	
	function up() 
	{			
		$values = array('period' => '');
		
		$this->db->where('period', '0000-00-00');
		
		$this->db->update('leave_card', $values);
				
	}

	function down() 
	{		
		return TRUE;
	}
}
