<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_budget_expenditures_table extends CI_Migration {
	
	function up() 
	{			
		if ( ! $this->db->table_exists('budget_expenditures'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'expenditures' => array('type' => 'VARCHAR', 'constraint' => 64),
				'office_id' => array('type' => 'INT', 'constraint' => '11', 'null' => TRUE),
				'year' => array('type' => 'INT', 'constraint' => '4', 'null' => FALSE),
				'budget_amount' => array('type' => 'DOUBLE', 'null' => FALSE),
				'account_code' => array('type' => 'VARCHAR', 'constraint' => '8', 'null' => FALSE),
				//'username' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				//'password' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				//'roles' => array('type' => 'TEXT', 'null' => TRUE),
				//'office_id' => array('type' => 'INT', 'constraint' => '11', 'null' => TRUE),
				//'effectivity_date_to' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				//'exemption' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				
		
			));
			
			$this->dbforge->create_table('budget_expenditures', TRUE);
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('budget_expenditures'))
		{
			$this->dbforge->drop_table('budget_expenditures');
		}
		
	}
}
