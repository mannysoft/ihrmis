<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_permissions_table extends CI_Migration {
	
	function up() 
	{			
		if ( ! $this->db->table_exists('permissions'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'group_id' => array('type' => 'INT', 'constraint' => 11),
				'module' => array('type' => 'VARCHAR', 'constraint' => '50', 'null' => FALSE),
				'roles' => array('type' => 'TEXT', 'null' => TRUE),
				//'office_id' => array('type' => 'INT', 'constraint' => '11', 'null' => TRUE),
				//'effectivity_date_to' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				//'exemption' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				
		
			));
			
			$this->dbforge->create_table('permissions', TRUE);
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('permissions'))
		{
			$this->dbforge->drop_table('permissions');
		}
		
	}
}
