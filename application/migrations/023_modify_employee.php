<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_employee extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "modifying employee table...";
		
		$fields = array(
                        'employee_id' => array(
                                                         'name' => 'id1',
                                                         'type' => 'INT( 11 ) NOT NULL AUTO_INCREMENT',
                                                ),
					);
					
		$this->dbforge->modify_column('employee', $fields);
		
		$fields = array(
                        'id' => array(
                                                         'name' => 'employee_id',
                                                         'type' => 'VARCHAR( 10 )',
                                                ),
					);
					
		$this->dbforge->modify_column('employee', $fields);
		
		$fields = array(
                        'id1' => array(
                                                         'name' => 'id',
                                                         'type' => 'INT( 11 ) NOT NULL AUTO_INCREMENT',
                                                ),
					);
					
		$this->dbforge->modify_column('employee', $fields);

	}

	function down() 
	{
		//$this->migrations->verbose AND print "deleting entries table settings...";
		
		/*
		$this->db->where('name', 'republic');
		$this->db->delete('settings');
		
		$this->db->where('name', 'lgu_name');
		$this->db->delete('settings');
		
		$this->db->where('name', 'lgu_office');
		$this->db->delete('settings');
		
		$this->db->where('name', 'lgu_address');
		$this->db->delete('settings');
		*/
	}
}
