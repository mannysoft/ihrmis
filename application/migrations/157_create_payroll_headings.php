<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_payroll_headings extends CI_Migration {
	
	function up() 
	{	
		
		
		
		if ( ! $this->db->table_exists('payroll_headings'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'line' => array('type' => 'INT', 'constraint' => '2', 'null' => FALSE),
				'type' => array('type' => 'ENUM', 'constraint' => "'additional','deductions'", 'null' => FALSE),
				'deduction_id' => array('type' => 'INT', 'constraint' => '16', 'null' => FALSE, 'comment' => 'record from additional or deduct info'),
				'order' => array('type' => 'INT', 'constraint' => '16', 'null' => FALSE),
				'status' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
		
			));
			
			$this->dbforge->create_table('payroll_headings', TRUE);
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('payroll_headings'))
		{
			$this->dbforge->drop_table('payroll_headings');
		}
		
	}
}
