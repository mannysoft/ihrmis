<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_groups_table extends CI_Migration {
	
	function up() 
	{			
		if ( ! $this->db->table_exists('groups'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'name' => array('type' => 'VARCHAR', 'constraint' => '128', 'null' => TRUE),
				'description' => array('type' => 'VARCHAR', 'constraint' => '256', 'null' => TRUE),
				//'office_id' => array('type' => 'INT', 'constraint' => '11', 'null' => TRUE),
				//'effectivity_date_to' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				//'exemption' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				
		
			));
			
			$this->dbforge->create_table('groups', TRUE);
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('groups'))
		{
			$this->dbforge->drop_table('groups');
		}
		
	}
}
