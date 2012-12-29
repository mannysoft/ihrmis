<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_deduction_informations_add_column_amount extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'amount' => array('type' => 'DOUBLE', 'null' => FALSE, 'DEFAULT' => '0')
);
		$this->dbforge->add_column('payroll_deduction_informations', $fields, 'optional_amount');
		
	}

	function down() 
	{		
		return TRUE;
	}
}
