<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_service_record extends CI_Migration {
	
	function up() 
	{	
		
		if ( ! $this->db->table_exists('service_record'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'employee_id' => array('type' => 'INT', 'constraint' => '11', 'null' => FALSE),
				'date_from' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'date_to' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'designation' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'status' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				'salary' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'office_entity' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'lwop' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'separation_date' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'separation_cause' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
		
			));
			
			$this->dbforge->create_table('service_record', TRUE);
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('service_record'))
		{
			$this->dbforge->drop_table('service_record');
		}
		
	}
}
