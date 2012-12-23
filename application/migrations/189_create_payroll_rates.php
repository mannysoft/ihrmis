<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_payroll_rates extends CI_Migration {
	
	function up() 
	{	
		if ( ! $this->db->table_exists('payroll_rates'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'employee_id' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'rate_per_day' => array('type' => 'DOUBLE', 'null' => FALSE),
				//'amount' => array('type' => 'DOUBLE', 'null' => FALSE),
				//'date_deduct' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				//'period' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				//'deduction_id' => array('type' => 'INT', 'constraint' => '16', 'null' => FALSE, 'comment' => 'record from additional or deduct info'),
				//'order' => array('type' => 'INT', 'constraint' => '16', 'null' => FALSE),
				//'description' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
		
			));
			
			$this->dbforge->create_table('payroll_rates', TRUE);
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('payroll_rates'))
		{
			$this->dbforge->drop_table('payroll_rates');
		}
		
	}
}
