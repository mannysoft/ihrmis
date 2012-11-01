<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_plantilla_items extends CI_Migration {
	
	function up() 
	{	
		if ( ! $this->db->table_exists('plantilla_items'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'office_id' => array('type' => 'INT', 'constraint' => '11', 'null' => FALSE),
				'item_no' => array('type' => 'VARCHAR', 'constraint' => '8', 'null' => FALSE),
				//'deduction_id' => array('type' => 'INT', 'constraint' => '16', 'null' => FALSE, 'comment' => 'record from additional or deduct info'),
				//'order' => array('type' => 'INT', 'constraint' => '16', 'null' => FALSE),
				'description' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
		
			));
			
			$this->dbforge->create_table('plantilla_items', TRUE);
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('plantilla_items'))
		{
			$this->dbforge->drop_table('plantilla_items');
		}
		
	}
}
