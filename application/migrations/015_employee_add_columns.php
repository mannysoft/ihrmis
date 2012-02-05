<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_employee_add_columns extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "adding employee table columns...";
		
		$fields = array(
                        'item_number' => array('type' => 'VARCHAR (32) NOT NULL')
		);
		$this->dbforge->add_column('employee', $fields);
		
		$fields = array(
                        'last_promotion' => array('type' => 'VARCHAR (32) NOT NULL')
		);
		$this->dbforge->add_column('employee', $fields);
		
		$fields = array(
                        'level' => array('type' => 'VARCHAR (64) NOT NULL')
		);
		$this->dbforge->add_column('employee', $fields);
		
		$fields = array(
                        'eligibility' => array('type' => 'VARCHAR (64) NOT NULL')
		);
		$this->dbforge->add_column('employee', $fields);
		
		
		$fields = array(
                        'graduated' => array('type' => 'VARCHAR (32) NOT NULL')
		);
		$this->dbforge->add_column('employee', $fields);
		
		$fields = array(
                        'course' => array('type' => 'VARCHAR (64) NOT NULL')
		);
		$this->dbforge->add_column('employee', $fields);
		
		$fields = array(
                        'units' => array('type' => 'VARCHAR (32) NOT NULL')
		);
		$this->dbforge->add_column('employee', $fields);
		
		
		$fields = array(
                        'post_grad' => array('type' => 'VARCHAR (64) NOT NULL')
		);
		$this->dbforge->add_column('employee', $fields);

	}

	function down() 
	{
		//$this->migrations->verbose AND print "dropping employee table columns...";
		
		$this->dbforge->drop_column('employee', 'item_number');
		$this->dbforge->drop_column('employee', 'last_promotion');
		$this->dbforge->drop_column('employee', 'level');
		$this->dbforge->drop_column('employee', 'eligibility');
		$this->dbforge->drop_column('employee', 'graduated');
		$this->dbforge->drop_column('employee', 'course');
		$this->dbforge->drop_column('employee', 'units');
		$this->dbforge->drop_column('employee', 'post_grad');
	}
}
