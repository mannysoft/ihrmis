<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_tax_table extends CI_Migration {
	
	function up() 
	{	
		
		if ( ! $this->db->table_exists('payroll_tax_table'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'start_range' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'end_range' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'fix_amount' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'percentage' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'over_limit' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				
		
			));
			
			$this->dbforge->create_table('payroll_tax_table', TRUE);
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('payroll_tax_table'))
		{
			$this->dbforge->drop_table('payroll_tax_table');
		}
		
	}
}
