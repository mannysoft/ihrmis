<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_employee_details extends CI_Migration {
	
	function up() 
	{			
		$lgu_code = Setting::getField( 'lgu_code' );
		
		if ($lgu_code == '')
		{
			if ( $this->db->table_exists('pds_profile'))
			{
				$this->db->order_by('id'); 
				
				$q = $this->db->get('pds_profile');
				
				if ($q->num_rows() > 0)
				{
					foreach ($q->result_array() as $row)
					{
						$p = new Employee_m();
		
						$p->get_by_id($row['employee_id']);
						
						$p->item_number	 	= $row['item_number'];
						$p->last_promotion 	= $row['last_promotion'];
						$p->level			= $row['level'];
						$p->eligibility 	= $row['eligibility'];
						$p->graduated	  	= $row['graduated'];
						$p->course  		= $row['course'];
						$p->units 		 	= $row['units'];
						$p->post_grad 	 	= $row['post_grad'];
								
						$p->save();
												
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
