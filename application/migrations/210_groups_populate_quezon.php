<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_groups_populate_quezon extends CI_Migration {
	
	function up() 
	{			
		$agency = $this->Settings->get_selected_field( 'system_name' );
		
		if ($agency == 'Provincial Government of Quezon')
		{
			$data = array(
 				 array('id' => '1','name' => 'Super System Administrator','description' => ''),
				 array('id' => '2','name' => 'System Administrator','description' => ''),
				 array('id' => '3','name' => 'Timekeeper','description' => ''),
				 array('id' => '4','name' => 'Official Business Encoder','description' => ''),
				 array('id' => '5','name' => 'Leave Manager','description' => ''),
				 array('id' => '6','name' => 'Leave Administrator','description' => ''),
				 array('id' => '7','name' => 'Records Administrator','description' => ''),
				 array('id' => '8','name' => 'View Attendance 10 Times Tardy','description' => ''),
				 array('id' => '9','name' => 'View Attendance Only','description' => 'View Attendance Only'),
		);

		$this->db->insert_batch('groups', $data); 
		}
	}

	function down() 
	{		
		return TRUE;
	}
}
