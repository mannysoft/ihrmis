<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_deduction_information extends CI_Migration {
	
	function up() 
	{	
		
		if ( ! $this->db->table_exists('deduction_informations'))
		{	
			
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				//'employee_id' => array('type' => 'INT', 'constraint' => '16', 'null' => FALSE),
				'code' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'desc' => array('type' => 'VARCHAR', 'constraint' => '128', 'null' => FALSE),
				'agency' => array('type' => 'INT', 'constraint' => '16', 'null' => FALSE),
				'type' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'mandatory' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'tax_exempted' => array('type' => 'VARCHAR', 'constraint' => '3', 'null' => FALSE),
				'er_share' => array('type' => 'VARCHAR', 'constraint' => '3', 'null' => FALSE),
				'official' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'optional_amount' => array('type' => 'VARCHAR', 'constraint' => '3', 'null' => FALSE),
				'amount_exempted' => array('type' => 'VARCHAR', 'constraint' => '8', 'null' => FALSE),
				'report_order' => array('type' => 'INT', 'constraint' => '4', 'null' => FALSE),
			));
			
			$this->dbforge->create_table('deduction_informations', TRUE);
			
			
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('deduction_informations'))
		{
			$this->dbforge->drop_table('deduction_informations');
		}
	
	}
}
