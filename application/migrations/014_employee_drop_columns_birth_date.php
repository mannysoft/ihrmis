<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_employee_drop_columns_birth_date extends CI_Migration {
	
	function up() 
	{	
		
		$this->dbforge->drop_column('employee', 'birth_date');
		$this->dbforge->drop_column('employee', 'place_birth');
		$this->dbforge->drop_column('employee', 'educ_qual');
		$this->dbforge->drop_column('employee', 'position_status');

	}

	function down() 
	{
		$fields = array(
                        'birth_date' => array('type' => 'DATE NOT NULL')
		);
		$this->dbforge->add_column('employee', $fields);
		
		$fields = array(
                        'place_birth' => array('type' => 'VARCHAR (100) NOT NULL')
		);
		$this->dbforge->add_column('employee', $fields);
		
		$fields = array(
                        'educ_qual' => array('type' => 'VARCHAR (100) NOT NULL')
		);
		$this->dbforge->add_column('employee', $fields);
		
		$fields = array(
                        'position_status' => array('type' => 'VARCHAR (15) NOT NULL')
		);
		$this->dbforge->add_column('employee', $fields);
	}
}
