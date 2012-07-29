<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_leave_wop_table extends CI_Migration {
	
	function up() 
	{	
		if ( ! $this->db->table_exists('leave_wop_table'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'days' => array('type' => 'DOUBLE', 'null' => FALSE),
				'days_leave_wop' => array('type' => 'DOUBLE', 'null' => FALSE),
				'leave_credits_earned' => array('type' => 'DOUBLE', 'null' => FALSE),
			));
			
			$this->dbforge->create_table('leave_wop_table', TRUE);
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('leave_wop_table'))
		{
			$this->dbforge->drop_table('leave_wop_table');
		}
		
	}
}
