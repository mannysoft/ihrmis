<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_employee_table_position extends CI_Migration {
	
	function up() 
	{	
		
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
		
		$fields = array(
                        'position' => array(
                                                         'name' => 'position',
                                                         'type' => 'VARCHAR(40) NOT NULL',
                                                ),
);
		$this->dbforge->modify_column('employee', $fields);	
	}
}
