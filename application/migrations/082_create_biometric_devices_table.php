<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_biometric_devices_table extends CI_Migration {
	
	function up() 
	{			
		if ( ! $this->db->table_exists('biometric_devices'))
		{	
			// Setup Keys
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field(array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
				'serial_no' => array('type' => 'VARCHAR', 'constraint' => 32),
				'model' => array('type' => 'VARCHAR', 'constraint' => '50', 'null' => FALSE),
				'ip' => array('type' => 'VARCHAR', 'constraint' => '50', 'null' => FALSE),
				'com_port' => array('type' => 'VARCHAR', 'constraint' => '4', 'null' => FALSE),
				'machine_number' => array('type' => 'VARCHAR', 'constraint' => '4', 'null' => FALSE),
				'username' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				'password' => array('type' => 'VARCHAR', 'constraint' => '64', 'null' => FALSE),
				//'roles' => array('type' => 'TEXT', 'null' => TRUE),
				//'office_id' => array('type' => 'INT', 'constraint' => '11', 'null' => TRUE),
				//'effectivity_date_to' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				//'exemption' => array('type' => 'VARCHAR', 'constraint' => '16', 'null' => FALSE),
				
		
			));
			
			$this->dbforge->create_table('biometric_devices', TRUE);
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('biometric_devices'))
		{
			$this->dbforge->drop_table('biometric_devices');
		}
		
	}
}
