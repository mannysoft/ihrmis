<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_schedule_add_column_am_in extends CI_Migration {
	
	function up() 
	{	
				
		$field = array('am_in' => array('type' => 'VARCHAR (8)', 'null' =>false));	
		
		$this->dbforge->add_column('schedule', $field, 'hour_to');
		
		$field = array('am_out' => array('type' => 'VARCHAR (8)', 'null' =>false));	
		
		$this->dbforge->add_column('schedule', $field, 'am_in');
		
		$field = array('pm_in' => array('type' => 'VARCHAR (8)', 'null' =>false));	
		
		$this->dbforge->add_column('schedule', $field, 'am_out');
		
		$field = array('pm_out' => array('type' => 'VARCHAR (8)', 'null' =>false));	
		
		$this->dbforge->add_column('schedule', $field, 'pm_in');
		
		
		// Search for schedule items
		$data = array();
						
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
				
		$q->free_result();

	}

	function down() 
	{
				
		$this->dbforge->drop_column('schedule', 'am_in');
		$this->dbforge->drop_column('schedule', 'am_out');
		$this->dbforge->drop_column('schedule', 'pm_in');
		$this->dbforge->drop_column('schedule', 'pm_out');
	}
}
