<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_pae extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "creating payroll_pae table...";
		
		if ( ! $this->db->table_exists('payroll_pae'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'tax_status' => array('type' => 'VARCHAR', 'constraint' => '32', 'null' => FALSE),
				'description' => array('type' => 'VARCHAR', 'constraint' => '256', 'null' => FALSE),
				'effectivity_date' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'effectivity_date_to' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'exemption' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				
		
			));
			
			$this->dbforge->create_table('payroll_pae', TRUE);
		}

	}

	function down() 
	{
		//$this->migrations->verbose AND print "dropping payroll_pae table...";
		
		if ( $this->db->table_exists('payroll_pae'))
		{
			$this->dbforge->drop_table('payroll_pae');
		}
		
	}
}
