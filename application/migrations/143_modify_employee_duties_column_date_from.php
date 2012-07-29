<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_employee_duties_column_date_from extends CI_Migration {
	
	
	function up() 
	{	
		
		$fields = array(
                        'duty_from' => array(
                                                       'name' => 'duty_from',
                                                       'type' => 'VARCHAR (32) NOT NULL',
                                             ),
		);
		
		$this->dbforge->modify_column('employee_duties', $fields);
		
		$fields = array(
                        'duty_to' => array(
                                                       'name' => 'duty_to',
                                                       'type' => 'VARCHAR (32) NOT NULL',
                                             ),
		);
		
		$this->dbforge->modify_column('employee_duties', $fields);

	}

	function down() 
	{
		return TRUE;
	}
}
