<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_plantilla extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "creating plantilla table...";
		
		if ( ! $this->db->table_exists('plantilla'))
		{	
			
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'employee_id' => array('type' => 'INT', 'constraint' => '16', 'null' => FALSE),
				'item_no' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'year' => array('type' => 'VARCHAR', 'constraint' => '4', 'null' => FALSE),
				'position' => array('type' => 'VARCHAR', 'constraint' => '128', 'null' => FALSE),
				'sg' => array('type' => 'VARCHAR', 'constraint' => '8', 'null' => FALSE),
				'amount' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				//'code' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				//'agency_name' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				//'report_order' => array('type' => 'INT', 'constraint' => '16', 'null' => FALSE),
			));
			
			$this->dbforge->create_table('plantilla', TRUE);
			
			
		}

	}

	function down() 
	{
		//$this->migrations->verbose AND print "dropping plantilla table...";
		
		if ( $this->db->table_exists('plantilla'))
		{
			$this->dbforge->drop_table('plantilla');
		}
	
	}
}
