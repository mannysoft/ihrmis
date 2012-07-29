<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_tax_table_columns extends CI_Migration {
	
	
	function up() 
	{	
		
		$fields = array(
                        'start_range' => array(
                                                     'name' => 'start_range',
                                                     'type' => 'DOUBLE NOT NULL',
                                                ),
				);
		
		$this->dbforge->modify_column('payroll_tax_table', $fields);
		
		$fields = array(
                        'end_range' => array(
                                                     'name' => 'end_range',
                                                     'type' => 'DOUBLE NOT NULL',
                                                ),
				);
		
		$this->dbforge->modify_column('payroll_tax_table', $fields);
		
		$fields = array(
                        'fix_amount' => array(
                                                     'name' => 'fix_amount',
                                                     'type' => 'DOUBLE NOT NULL',
                                                ),
				);
		
		$this->dbforge->modify_column('payroll_tax_table', $fields);
		
		$fields = array(
                        'percentage' => array(
                                                     'name' => 'percentage',
                                                     'type' => 'DOUBLE NOT NULL',
                                                ),
				);
		
		$this->dbforge->modify_column('payroll_tax_table', $fields);
		
		
		$fields = array(
                        'over_limit' => array(
                                                     'name' => 'over_limit',
                                                     'type' => 'DOUBLE NOT NULL',
                                                ),
				);
		
		$this->dbforge->modify_column('payroll_tax_table', $fields);

	}

	function down() 
	{
		return TRUE;
	}
}
