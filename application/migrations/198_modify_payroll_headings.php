<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_payroll_headings extends CI_Migration {
	
	
	function up() 
	{	
		
		$fields = array(
                        'type' => array('type' => 'ENUM', 'constraint' => "'additional','deductions'", 'null' => FALSE)
		);
		
		$this->dbforge->modify_column('payroll_headings', $fields);
	}

	function down() 
	{
		return TRUE;
	}
}
