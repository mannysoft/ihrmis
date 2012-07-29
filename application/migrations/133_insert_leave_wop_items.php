<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_leave_wop_items extends CI_Migration {
	
	function up() 
	{	
			return TRUE;
			
			$days = 30;
			
			$wop = 0;
			
			while ($days >= 0)
			{
				echo $days.'-'.$wop.'<br>';
				$days -= 0.5;
				$wop += 0.5;
			}
			
			return FALSE;
			
		
			foreach ($items as $item)
			{
				/*
				$data = array(
							'' => '',
							'' => '',
							'' => '',
							);
				*/
				$this->db->insert('leave_wop_table', $item);
			}	
		
			

	}

	function down() 
	{
		return TRUE;
		
		//$this->db->where('id', '23');
		//$this->db->delete('leave_type');
	}
}
