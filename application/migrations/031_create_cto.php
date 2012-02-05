<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_cto extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "creating compensatory_timeoff table...";
		
		if ( ! $this->db->table_exists('compensatory_timeoff'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'employee_id' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'month' => array('type' => 'VARCHAR', 'constraint' => '2', 'null' => FALSE),
				'year' => array('type' => 'VARCHAR', 'constraint' => '4', 'null' => FALSE),
				'days' => array('type' => 'VARCHAR', 'constraint' => '3', 'null' => FALSE),
				'dates' => array('type' => 'VARCHAR', 'constraint' => '128', 'null' => FALSE),
				'type' => array('type' => 'VARCHAR', 'constraint' => '8', 'null' => FALSE),
				'status' => array('type' => 'VARCHAR', 'constraint' => '8', 'null' => FALSE),
			));
			
			$this->dbforge->create_table('compensatory_timeoff', TRUE);
		}

	}

	function down() 
	{
		//$this->migrations->verbose AND print "dropping compensatory_timeoff table...";
		
		if ( $this->db->table_exists('compensatory_timeoff'))
		{
			$this->dbforge->drop_table('compensatory_timeoff');
		}
		
	}
}
