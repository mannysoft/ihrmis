<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_deduction_loans extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "creating create_deduction_loans table...";
		
		if ( ! $this->db->table_exists('deduction_loans'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'employee_id' => array('type' => 'INT', 'constraint' => '11', 'null' => FALSE),
				'deduction_information_id' => array('type' => 'INT', 'constraint' => '11', 'null' => FALSE),
				'date_loan' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'loan_gross' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'months_pay' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'monthly_pay' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'date_from' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'date_to' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'status' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
		
			));
			
			$this->dbforge->create_table('deduction_loans', TRUE);
		}

	}

	function down() 
	{
		//$this->migrations->verbose AND print "dropping deduction_loans table...";
		
		if ( $this->db->table_exists('deduction_loans'))
		{
			$this->dbforge->drop_table('deduction_loans');
		}
		
	}
}
