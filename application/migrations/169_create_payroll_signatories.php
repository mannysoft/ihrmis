<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_payroll_signatories extends CI_Migration {
	
	function up() 
	{	
		if ( ! $this->db->table_exists('payroll_signatories'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				//'employee_id' => array('type' => 'INT', 'constraint' => '11', 'null' => FALSE),
				//'payroll_pae_id' => array('type' => 'INT', 'constraint' => '11', 'null' => FALSE),
				//'amount' => array('type' => 'DOUBLE', 'null' => FALSE),
				'part' => array('type' => 'VARCHAR', 'constraint' => '4', 'null' => FALSE),
				'name' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				'designation' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				//'period' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				//'deduction_id' => array('type' => 'INT', 'constraint' => '16', 'null' => FALSE, 'comment' => 'record from additional or deduct info'),
				//'order' => array('type' => 'INT', 'constraint' => '16', 'null' => FALSE),
				//'description' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
		
			));
			
			$this->dbforge->create_table('payroll_signatories', TRUE);
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('payroll_signatories'))
		{
			$this->dbforge->drop_table('payroll_signatories');
		}
		
	}
}
