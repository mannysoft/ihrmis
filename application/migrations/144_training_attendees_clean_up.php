<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_training_attendees_clean_up extends CI_Migration {
	
	function up() 
	{					
		if ( $this->db->table_exists('training_attendees'))
		{				
			$q = $this->db->get('training_attendees');
							
			if ($q->num_rows() > 0)
			{
				foreach ($q->result_array() as $row)
				{
					$e = new Employee_m();
					
					$e->get_by_id($row['employee_id']);
					
					if ( ! $e->exists())
					{
						$this->db->where('id', $row['id']);
						$this->db->delete('training_attendees');
						//echo $this->db->last_query().'<br>';
						
					}
											
				}
			}
			
			$this->db->where('event_id', 0);
			$this->db->delete('training_attendees');

		}	
	}

	function down() 
	{		
		return TRUE;
	}
}
