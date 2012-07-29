<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_employee extends CI_Migration {
	
	function up() 
	{					
		if ( $this->db->table_exists('pds_personal_info'))
		{				
			$q = $this->db->get('pds_personal_info');
							
			if ($q->num_rows() > 0)
			{
				foreach ($q->result_array() as $row)
				{
					$e = new Employee_m();
					
					$e->get_by_id($row['employee_id']);
											
					$e->birth_date	= $row['birth_date'];
					$e->sex			= $row['sex'];
					$e->save();
									
				}
			}

		}	
	}

	function down() 
	{		
		return TRUE;
	}
}
