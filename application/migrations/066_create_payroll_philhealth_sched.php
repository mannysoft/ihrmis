<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_payroll_philhealth_sched extends CI_Migration {
	
	function up() 
	{	
		
		if ( ! $this->db->table_exists('payroll_philhealth_schedules'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'effectivity_date' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'effectivity_date_to' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'start_range' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'end_range' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'salary_based' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'monthly_share' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'employee_share' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'employer_share' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				
		
			));
			
			$this->dbforge->create_table('payroll_philhealth_schedules', TRUE);
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('payroll_philhealth_schedules'))
		{
			$this->dbforge->drop_table('payroll_philhealth_schedules');
		}
		
	}
}
