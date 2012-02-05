<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_employee_table extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "modifying employee table...";
		
		$fields = array(
                        'position' => array(
                                                         'name' => 'position',
                                                         'type' => 'VARCHAR(64) NOT NULL',
                                                ),
);
		$this->dbforge->modify_column('employee', $fields);	
		
		

	}

	function down() 
	{
		//$this->migrations->verbose AND print "modifying employee table...";
		
		$fields = array(
                        'position' => array(
                                                         'name' => 'position',
                                                         'type' => 'VARCHAR(40) NOT NULL',
                                                ),
);
		$this->dbforge->modify_column('employee', $fields);	
	}
}
