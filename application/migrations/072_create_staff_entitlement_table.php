<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_staff_entitlement_table extends CI_Migration {
	
	function up() 
	{			
		if ( ! $this->db->table_exists('payroll_staff_entitlement'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'employee_id' => array('type' => 'INT', 'constraint' => '11', 'null' => FALSE),
				'additional_compensation_id' => array('type' => 'INT', 'constraint' => '11', 'null' => FALSE),
				'effectivity_date' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				'ineffectivity_date' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				//'frequency' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'amount' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				//'deductible' => array('type' => 'VARCHAR', 'constraint' => '4', 'null' => FALSE),
				//'basis' => array('type' => 'VARCHAR', 'constraint' => '8', 'null' => FALSE),
				//'status' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				
		
			));
			
			$this->dbforge->create_table('payroll_staff_entitlement', TRUE);
		}

	}

	function down() 
	{		
		if ( $this->db->table_exists('payroll_staff_entitlement'))
		{
			$this->dbforge->drop_table('payroll_staff_entitlement');
		}
		
	}
}
