<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_user extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "modifying user table...";
		
		$fields = array(
                        'stat' => array(
                                                         'name' => 'stat',
                                                         'type' => 'VARCHAR( 16 ) NOT NULL',
                                                ),
					);
					
		$this->dbforge->modify_column('user', $fields);
		
		$data = array('stat' => 'Active');
		
		$this->db->where('stat', 1);
		$this->db->update('user', $data);
		
		//$data = array('stat' => 'Inactive');
		
		//$this->db->where('stat', 0);
		//$this->db->update('user', $data);
		

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
