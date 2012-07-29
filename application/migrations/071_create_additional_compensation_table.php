<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_additional_compensation_table extends CI_Migration {
	
	function up() 
	{			
		if ( ! $this->db->table_exists('payroll_additional_compensation'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'code' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'name' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'taxable' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'frequency' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'order' => array('type' => 'INT', 'constraint' => '2', 'null' => FALSE),
				'deductible' => array('type' => 'VARCHAR', 'constraint' => '4', 'null' => FALSE),
				'basis' => array('type' => 'VARCHAR', 'constraint' => '8', 'null' => FALSE),
				'status' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				
		
			));
			
			$this->dbforge->create_table('payroll_additional_compensation', TRUE);
		}

	}

	function down() 
	{		
		if ( $this->db->table_exists('payroll_additional_compensation'))
		{
			$this->dbforge->drop_table('payroll_additional_compensation');
		}
		
	}
}
