<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_payroll_disbursing_officers extends CI_Migration {
	
	function up() 
	{	
		if ( ! $this->db->table_exists('payroll_disbursing_officers'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'name' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				//'employee_id' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				//'days' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
		
			));
			
			$this->dbforge->create_table('payroll_disbursing_officers', TRUE);
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('payroll_disbursing_officers'))
		{
			$this->dbforge->drop_table('payroll_disbursing_officers');
		}
		
	}
}
