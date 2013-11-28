<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_populate_service_record extends CI_Migration {
	
	function up() 
	{			
		$lgu_code = Setting::getField( 'lgu_code' );
		
		if ($lgu_code == '')
		{
			if ( $this->db->table_exists('pds_work_experience'))
			{
				$this->db->where('govt_service', 1);
				$this->db->order_by('id'); 
				
				$q = $this->db->get('pds_work_experience');
								
				if ($q->num_rows() > 0)
				{
					foreach ($q->result_array() as $row)
					{
						$s = new Service_record();
												
						$s->employee_id	 	= $row['employee_id'];
						$s->date_from	 	= $row['inclusive_date_from'];
						$s->date_to 		= $row['inclusive_date_to'];
						$s->designation	 	= $row['position'];
						$s->status 			= $row['status'];
						$s->salary	 		= $row['monthly_salary'];
						$s->office_entity 	= $row['company'];
								
						$s->save();
										
					}
				}
	
			}	
		}
		
	}

	function down() 
	{		
		return TRUE;
	}
}
