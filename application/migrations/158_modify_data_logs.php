<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_data_logs extends CI_Migration {
	
	
	function up() 
	{	
		
		$fields = array(
                        'date' => array(
                                                       'name' => 'date',
                                                       'type' => 'VARCHAR(30)',
                                             ),
		);
		
		$this->dbforge->modify_column('logs', $fields);
		
		
		
		$this->db->where('command', 'EDIT USER');
		$this->db->update('logs', array('module' => 'users'));
		
		$this->db->where('command', 'EDIT EMPLOYEE');
		$this->db->update('logs', array('module' => 'employees'));
		
		$this->db->where('command', 'ADD EMPLOYEE');
		$this->db->update('logs', array('module' => 'employees'));
		
		$this->db->where('command', 'EDIT LOGS');
		$this->db->update('logs', array('module' => 'attendance'));
		
		$this->db->where('command', 'Official Business EVENT');
		$this->db->update('logs', array('module' => 'attendance'));
		
		$this->db->where('command', 'ADD USER');
		$this->db->update('logs', array('module' => 'users'));
		
		$this->db->where('command', 'DELETE USER');
		$this->db->update('logs', array('module' => 'users'));
		
		$this->db->where('command', 'MANUAL LOG');
		$this->db->update('logs', array('module' => 'attendance'));
		
		$fields = array(
                        'date' => array(
                                                       'name' => 'date',
                                                       'type' => 'TIMESTAMP',
                                             ),
		);
		
		$this->dbforge->modify_column('logs', $fields);
		
		
	}

	function down() 
	{
		return TRUE;
	}
}
