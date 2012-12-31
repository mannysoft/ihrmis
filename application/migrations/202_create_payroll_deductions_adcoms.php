<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_payroll_deductions_adcoms extends CI_Migration {
	
	function up() 
	{	
		if ( ! $this->db->table_exists('payroll_deduction_adcoms'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'employee_id' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'deduction_id' => array('type' => 'INT', 'constraint' => '16', 'null' => FALSE, 'comment' => 'if deductions'),
				'additional_compensation_id' => array('type' => 'INT', 'constraint' => '16', 'null' => FALSE, 'comment' => 'if additional compensation'),
				'amount' => array('type' => 'DOUBLE', 'null' => FALSE),
				'monthly_salary' => array('type' => 'DOUBLE', 'null' => FALSE),
				'date' => array('type' => 'DATE', 'null' => FALSE, 'comment' => 'date of deductions'),
				'status' => array('type' => 'ENUM("Active", "Inactive")', 'null' => FALSE, 'default' => 'Active'),
				//'hours' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				//'days' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				//'amount' => array('type' => 'DOUBLE', 'null' => FALSE),
				//'date_deduct' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				//'period' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				//'deduction_id' => array('type' => 'INT', 'constraint' => '16', 'null' => FALSE, 'comment' => 'record from additional or deduct info'),
				//'order' => array('type' => 'INT', 'constraint' => '16', 'null' => FALSE),
				//'description' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
		
			));
			
			$this->dbforge->create_table('payroll_deduction_adcoms', TRUE);
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('payroll_deduction_adcoms'))
		{
			$this->dbforge->drop_table('payroll_deduction_adcoms');
		}
		
	}
}
