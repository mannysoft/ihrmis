<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_deduction_informations_add_column_reference extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'reference_table' => array('type' => 'VARCHAR(32)', 'null' => FALSE, 'DEFAULT' => '')
);
		$this->dbforge->add_column('payroll_deduction_informations', $fields, 'optional_amount');
		
	}

	function down() 
	{		
		return TRUE;
	}
}
