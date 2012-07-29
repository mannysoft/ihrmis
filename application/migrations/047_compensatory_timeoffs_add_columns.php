<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_compensatory_timeoffs_add_columns extends CI_Migration {
	
	function up() 
	{			
		
		$data = array();
		
		$fields = array(
                        'office_id' => array('type' => 'INT (16)', 'null' => FALSE)
						);
						
		$this->dbforge->add_column('compensatory_timeoffs', $fields, 'employee_id');		
		
		//$this->db->where('employee_id', $employee_id); 
		$q = $this->db->get('compensatory_timeoffs');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				//$data = $row;
				
				// get employee info
				$employee = $this->Employee->get_employee_info($row['employee_id']);
				
				//update office id
				$data = array('office_id' => $employee['office_id']);
				$this->db->where('employee_id', $row['employee_id']);
				$this->db->update('compensatory_timeoffs', $data); 
			}
		}

		return $data;
		
		$q->free_result();
		
		
		
	}

	function down() 
	{
		
		$this->dbforge->drop_column('compensatory_timeoffs', 'office_id');
		
		
	}
}
