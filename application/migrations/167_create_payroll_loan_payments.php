<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_payroll_loan_payments extends CI_Migration {
	
	function up() 
	{	
		if ( ! $this->db->table_exists('payroll_loan_payments'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'employee_id' => array('type' => 'INT', 'constraint' => '11', 'null' => FALSE),
				'payroll_deduction_loans_id' => array('type' => 'INT', 'constraint' => '11', 'null' => FALSE),
				'amount' => array('type' => 'DOUBLE', 'null' => FALSE),
				'date_deduct' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				'period' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				//'deduction_id' => array('type' => 'INT', 'constraint' => '16', 'null' => FALSE, 'comment' => 'record from additional or deduct info'),
				//'order' => array('type' => 'INT', 'constraint' => '16', 'null' => FALSE),
				//'description' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
		
			));
			
			$this->dbforge->create_table('payroll_loan_payments', TRUE);
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('payroll_loan_payments'))
		{
			$this->dbforge->drop_table('payroll_loan_payments');
		}
		
	}
}
