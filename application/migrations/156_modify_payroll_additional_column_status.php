<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_payroll_additional_column_status extends CI_Migration {
	
	
	function up() 
	{	
		
		$fields = array(
                        'status' => array(
                                                       'name' => 'status',
                                                       'type' => "ENUM('Active','Inactive' ) NOT NULL",
													   'default' => 'Active',
                                             ),
		);
		
		$this->dbforge->modify_column('payroll_additional_compensation', $fields);

	}

	function down() 
	{
		return TRUE;
	}
}
