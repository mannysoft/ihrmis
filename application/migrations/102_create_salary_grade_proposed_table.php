<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_salary_grade_proposed_table extends CI_Migration {
	
	function up() 
	{			
		if ( ! $this->db->table_exists('salary_grade_proposed'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'sg' => array('type' => 'INT', 'constraint' => '11', 'null' => FALSE),
				'step1' => array('type' => 'DOUBLE (15,2)', 'null' => FALSE),
				'step2' => array('type' => 'DOUBLE (15,2)', 'null' => FALSE),
				'step3' => array('type' => 'DOUBLE (15,2)', 'null' => FALSE),
				'step4' => array('type' => 'DOUBLE (15,2)', 'null' => FALSE),
				'step5' => array('type' => 'DOUBLE (15,2)', 'null' => FALSE),
				'step6' => array('type' => 'DOUBLE (15,2)', 'null' => FALSE),
				'step7' => array('type' => 'DOUBLE (15,2)', 'null' => FALSE),
				'step8' => array('type' => 'DOUBLE (15,2)', 'null' => FALSE),
				'year' => array('type' => 'VARCHAR (4)', 'null' => FALSE),
				'salary_grade_type' => array('type' => 'VARCHAR (16)', 'null' => FALSE),
				//'account_code' => array('type' => 'VARCHAR', 'constraint' => '8', 'null' => FALSE),
				//'username' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				//'password' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				//'roles' => array('type' => 'TEXT', 'null' => TRUE),
				//'office_id' => array('type' => 'INT', 'constraint' => '11', 'null' => TRUE),
				//'effectivity_date_to' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				//'exemption' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				
		
			));
			
			$this->dbforge->create_table('salary_grade_proposed', TRUE);
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('salary_grade_proposed'))
		{
			$this->dbforge->drop_table('salary_grade_proposed');
		}
		
	}
}
