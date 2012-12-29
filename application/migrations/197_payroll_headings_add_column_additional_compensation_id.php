<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_payroll_headings_add_column_additional_compensation_id extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'caption' => array('type' => 'VARCHAR(32)', 'null' => FALSE, 'DEFAULT' => ''),
						'additional_compensation_id' => array('type' => 'INT', 'null' => FALSE, 'DEFAULT' => '0')
						
		);
		$this->dbforge->add_column('payroll_headings', $fields, 'deduction_id');
		
	}

	function down() 
	{		
		return TRUE;
	}
}
