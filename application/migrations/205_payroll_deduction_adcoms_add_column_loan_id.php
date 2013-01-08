<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_payroll_deduction_adcoms_add_column_loan_id extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'loan_id' => array('type' => 'INT', 'null' => FALSE, 'DEFAULT' => '0'),
						
						
		);
		$this->dbforge->add_column('payroll_deduction_adcoms', $fields, 'deduction_id');
		
	}

	function down() 
	{		
		return TRUE;
	}
}
