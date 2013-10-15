<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_employee_id_requests_table extends CI_Migration {
	
	function up() 
	{			
		if ( ! $this->db->table_exists('employee_id_requests'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'employee_id' => array('type' => 'INT', 'constraint' => '11', 'null' => FALSE),
				'status' => array('type' => 'ENUM ("requested", "for_printing","released")'),
				'date_request' => array('type' => 'DATE', 'null' => TRUE),
				//'amount' => array('type' => 'DOUBLE', 'null' => FALSE),
				//'account_code' => array('type' => 'VARCHAR', 'constraint' => '8', 'null' => FALSE),
				//'username' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				//'password' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				//'roles' => array('type' => 'TEXT', 'null' => TRUE),
				//'office_id' => array('type' => 'INT', 'constraint' => '11', 'null' => TRUE),
				//'effectivity_date_to' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				//'exemption' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				
		
			));
			
			$this->dbforge->create_table('employee_id_requests', TRUE);
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('employee_id_requests'))
		{
			$this->dbforge->drop_table('employee_id_requests');
		}
		
	}
}
