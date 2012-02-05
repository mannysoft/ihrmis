<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_schedule_add_column extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "adding column to schedule table";
		
		$fields = array(
                        'am_in' => array('type' => 'VARCHAR (8) NOT NULL AFTER `hour_to`'),
						'am_out' => array('type' => 'VARCHAR (8) NOT NULL AFTER `am_in`'),
						'pm_in' => array('type' => 'VARCHAR (8) NOT NULL AFTER `am_out`'),
						'pm_out' => array('type' => 'VARCHAR (8) NOT NULL AFTER `pm_in`')
						);
						
		$this->dbforge->add_column('schedule', $fields);
		
		// Search for schedule items
		$data = array();
				
		//$this->db->where('employee_id', $employee_id);
		//$this->db->where('date', $date);
		
		$q = $this->db->get('schedule');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				
				if ( $row['hour_from'] != '')
				{
					// If PM
					if ( $row['hour_from'] >= '12:00')
					{
						// Update the pm_in
						$this->db->where('id', $row['id']);
						$this->db->update('schedule', array('pm_in' => $row['hour_from']));
					}
					else // If AM
					{
						// Update the am_in
						$this->db->where('id', $row['id']);
						$this->db->update('schedule', array('am_in' => $row['hour_from']));
					}
				}
				
				
				if ( $row['hour_to'] != '')
				{
					// If PM
					if ( $row['hour_to'] >= '12:00')
					{
						// Update the pm_in
						$this->db->where('id', $row['id']);
						$this->db->update('schedule', array('pm_out' => $row['hour_to']));
					}
					else // If AM
					{
						// Update the am_in
						$this->db->where('id', $row['id']);
						$this->db->update('schedule', array('am_out' => $row['hour_to']));
					}
				}
				
			}
		}
		
		//return $data;
		
		$q->free_result();

	}

	function down() 
	{
		
		//$this->migrations->verbose AND print "dropping column from schedule table";
		
		$this->dbforge->drop_column('schedule', 'am_in');
		$this->dbforge->drop_column('schedule', 'am_out');
		$this->dbforge->drop_column('schedule', 'pm_in');
		$this->dbforge->drop_column('schedule', 'pm_out');
	}
}
