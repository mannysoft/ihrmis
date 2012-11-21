<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_payroll_sss_tables extends CI_Migration {
	
	function up() 
	{	
		if ( ! $this->db->table_exists('payroll_sss_tables'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				//'employee_id' => array('type' => 'INT', 'constraint' => '11', 'null' => FALSE),
				//'payroll_pae_id' => array('type' => 'INT', 'constraint' => '11', 'null' => FALSE),
				//'amount' => array('type' => 'DOUBLE', 'null' => FALSE),
				'range_from' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'range_to' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'monthly_salary' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'ss_er' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'ss_ee' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'ss_total' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'ec_er' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'tc_er' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'tc_ee' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'tc_total' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'total_contribution' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				//'period' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				//'deduction_id' => array('type' => 'INT', 'constraint' => '16', 'null' => FALSE, 'comment' => 'record from additional or deduct info'),
				//'order' => array('type' => 'INT', 'constraint' => '16', 'null' => FALSE),
				//'description' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
		
			));
			
			$this->dbforge->create_table('payroll_sss_tables', TRUE);
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('payroll_sss_tables'))
		{
			$this->dbforge->drop_table('payroll_sss_tables');
		}
		
	}
}
