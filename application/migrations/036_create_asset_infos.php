<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_asset_infos extends CI_Migration {
	
	function up() 
	{	
		
		if ( ! $this->db->table_exists('asset_infos'))
		{	
			
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'employee_id' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				's_lname' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				's_fname' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				's_mname' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				's_position' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				's_office' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				's_tin' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				's_cc_no' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				's_issue_at' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				's_issue_date' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'tin' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'cc_no' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'issue_at' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				'issue_date' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
			));
			
			$this->dbforge->create_table('asset_infos', TRUE);
			
			
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('asset_infos'))
		{
			$this->dbforge->drop_table('asset_infos');
		}
	
	}
}
