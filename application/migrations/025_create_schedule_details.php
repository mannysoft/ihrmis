<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_schedule_details extends CI_Migration {
	
	function up() 
	{	
		
		if ( ! $this->db->table_exists('schedules'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' 		=> array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'name' 		=> array('type' => 'VARCHAR', 'constraint' => '128', 'null' => FALSE),
				'times' 	=> array('type' => 'TEXT', 'null' => FALSE),
		
			));
			
			$this->dbforge->create_table('schedules', TRUE);
		}
		
		if ( ! $this->db->table_exists('schedule_details'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' 				=> array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'name' 				=> array('type' => 'VARCHAR', 'constraint' => '128', 'null' => FALSE),
				'employees' 		=> array('type' => 'TEXT', 'null' => FALSE),
				'dates' 			=> array('type' => 'TEXT', 'null' => FALSE),
				'schedule_id' 		=> array('type' => 'INT', 'constraint' => 11, 'null' => FALSE),
		
			));
			
			$this->dbforge->create_table('schedule_details', TRUE);
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('schedule_details'))
		{
			$this->dbforge->drop_table('schedule_details');
		}
		if ( $this->db->table_exists('schedules'))
		{
			$this->dbforge->drop_table('schedules');
		}
		
	}
}
