<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_employee_add_columns_division_id extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'division_id' => array('type' => 'INT (4)', 'null' => FALSE)
);
		$this->dbforge->add_column('employee', $fields, 'office_id');
		
		$fields = array(
                        'section_id' => array('type' => 'INT (4)', 'null' => FALSE)
);
		$this->dbforge->add_column('employee', $fields, 'division_id');
		
	}

	function down() 
	{		
		$this->dbforge->drop_column('employee', 'division_id');
		$this->dbforge->drop_column('employee', 'section_id');
		
		
	}
}
