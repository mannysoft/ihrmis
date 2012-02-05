<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_employee_modify_columns extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "modifying employee table columns...";
		
		$fields = array(
                        'sex' => array(
                                                         'name' => 'sex',
                                                         'type' => 'VARCHAR (4) NOT NULL',
                                                ),
		);
		
		$this->dbforge->modify_column('employee', $fields);
		
		$data = array('sex' => 'M');
		$this->db->where('sex', '1');
		$this->db->update('employee', $data);
		
		$data = array('sex' => 'F');
		$this->db->where('sex', '2');
		$this->db->update('employee', $data);

	}

	function down() 
	{
		//$this->migrations->verbose AND print "modifying employee table columns...";
		
		$fields = array(
                        'sex' => array(
                                                         'name' => 'sex',
                                                         'type' => 'DOUBLE',
                                                ),
		);
		
		$this->dbforge->modify_column('employee', $fields);
		
		$data = array('sex' => '1');
		$this->db->where('sex', 'M');
		$this->db->update('employee', $data);
		
		$data = array('sex' => '2');
		$this->db->where('sex', 'F');
		$this->db->update('employee', $data);
	}
}
