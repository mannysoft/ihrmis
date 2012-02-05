<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_asset_unmarried extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "creating asset_unmarrieds table...";
		
		if ( ! $this->db->table_exists('asset_unmarrieds'))
		{	
			
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'employee_id' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'name' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'birth_date' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
			));
			
			$this->dbforge->create_table('asset_unmarrieds', TRUE);
			
			
		}

	}

	function down() 
	{
		//$this->migrations->verbose AND print "dropping asset_unmarrieds table...";
		
		if ( $this->db->table_exists('asset_unmarrieds'))
		{
			$this->dbforge->drop_table('asset_unmarrieds');
		}
	
	}
}
