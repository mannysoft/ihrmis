<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_deduction_agencies extends CI_Migration {
	
	function up() 
	{	
		
		if ( ! $this->db->table_exists('deduction_agencies'))
		{	
			
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'code' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'agency_name' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'report_order' => array('type' => 'INT', 'constraint' => '16', 'null' => FALSE)
			));
			
			$this->dbforge->create_table('deduction_agencies', TRUE);
			
			
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('deduction_agencies'))
		{
			$this->dbforge->drop_table('deduction_agencies');
		}
	
	}
}
