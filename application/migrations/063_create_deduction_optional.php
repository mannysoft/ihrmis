<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_deduction_optional extends CI_Migration {
	
	function up() 
	{	
		
		
		
		if ( ! $this->db->table_exists('deduction_optional'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'employee_id' => array('type' => 'INT', 'constraint' => '11', 'null' => FALSE),
				'deduction_information_id' => array('type' => 'INT', 'constraint' => '11', 'null' => FALSE),
				'date_from' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'date_to' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'status' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
		
			));
			
			$this->dbforge->create_table('deduction_optional', TRUE);
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('deduction_optional'))
		{
			$this->dbforge->drop_table('deduction_optional');
		}
		
	}
}
