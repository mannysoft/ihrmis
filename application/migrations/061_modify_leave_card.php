<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_leave_card extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "deleting double entries...";
		
		//$this->db->select('am_login, am_logout, pm_login, pm_logout, log_date');
		//$this->db->where('log_date = ADDDATE('.'"'.$log_date.'"'.', 1)');
		//$this->db->where('employee_id', $employee_id); 
		$q = $this->db->get('employee');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				//$data = $row;
				// check leave card
				$this->db->where('period', '2011-12-31');
				$this->db->where('particulars', '');
				$this->db->where('employee_id', $row['employee_id']);
				
				$q2 = $this->db->get('leave_card');
				
				if ($q2->num_rows() == 2)
				{
					
					$this->db->where('period', '2011-12-31');
					$this->db->where('particulars', '');
					$this->db->where('employee_id', $row['employee_id']);
					$this->db->limit(1);
					
					$this->db->delete('leave_card');
				}
				
			}
		}
		
	}

	function down() 
	{
		//$this->migrations->verbose AND print "deleting hospital_view_leave_days from table settings...";
	}
}
