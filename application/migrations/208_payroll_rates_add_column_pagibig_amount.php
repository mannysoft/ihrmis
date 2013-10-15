<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_payroll_rates_add_column_pagibig_amount extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'pagibig_amount' => array('type' => 'DOUBLE', 'null' => FALSE, 'DEFAULT' => '0')
);
		$this->dbforge->add_column('payroll_rates', $fields, 'rate_per_day');			
	}

	function down() 
	{		
		return TRUE;
	}
}
