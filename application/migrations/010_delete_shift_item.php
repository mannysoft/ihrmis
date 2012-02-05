<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_delete_shift_item extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "deleting shift table items...";
		
		$this->db->where('name', '');
		$this->db->delete('shift');
				
		$this->db->where('name', '8 Hours (2pm - 10pm)');
		$this->db->delete('shift');
		
		$this->db->where('name', '8 Hours (6am - 2pm)');
		$this->db->update('shift', array('name' => 'Hospital Style Working Hours'));
		
		$this->db->where('name', '8 Hours (10pm - 6am)');
		$this->db->update('shift', 
					array('name' => 'Special Working Hours', 'description' => '6am - 12 noon - 3pm - 5pm,  -- ')
					);
					
		$this->db->where('shift_id', 4);
		$this->db->update('shift', array('shift_id' => 3));			
		
		$this->db->where('shift_id', 5);
		$this->db->update('shift', array('shift_id' => 4));			
		
		

	}

	function down() 
	{
		
	}
}
