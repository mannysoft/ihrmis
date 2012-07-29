<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_appointment_issued extends CI_Migration {
	
	function up() 
	{	
		if ( ! $this->db->table_exists('appointment_issued'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'employee_id' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'position' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'sg' => array('type' => 'VARCHAR', 'constraint' => '8', 'null' => FALSE),
				'status' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				'nature' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'item_no' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'publication' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				'issuance' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				'received_csc' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				'acted_upon' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				'kss' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				'pdf' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				'pds' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				'education' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				'eligibility' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				'nbi' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				'oath' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				'med_cert' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				'saln' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				'pes' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				'remarks' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'year' => array('type' => 'VARCHAR', 'constraint' => '4', 'null' => FALSE),
				//'dates' => array('type' => 'VARCHAR', 'constraint' => '128', 'null' => FALSE),
				//'type' => array('type' => 'VARCHAR', 'constraint' => '8', 'null' => FALSE),
				//'status' => array('type' => 'VARCHAR', 'constraint' => '8', 'null' => FALSE),
			));
			
			$this->dbforge->create_table('appointment_issued', TRUE);
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('appointment_issued'))
		{
			$this->dbforge->drop_table('appointment_issued');
		}
		
	}
}
