<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_employee_add_columns_tax_status extends CI_Migration {
	
	function up() 
	{	
		
		$fields = array(
                        'tax_status' => array('type' => 'VARCHAR (32) NOT NULL')
		);
		$this->dbforge->add_column('employee', $fields);
		
		$fields = array(
                        'dependents' => array('type' => 'VARCHAR (32) NOT NULL')
		);
		$this->dbforge->add_column('employee', $fields);
		
		

	}

	function down() 
	{
		
		$this->dbforge->drop_column('employee', 'tax_status');
		$this->dbforge->drop_column('employee', 'dependents');
	}
}
