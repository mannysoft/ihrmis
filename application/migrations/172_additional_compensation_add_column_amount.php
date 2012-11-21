<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_additional_compensation_add_column_amount extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'amount' => array('type' => 'DOUBLE', 'null' => FALSE, 'DEFAULT' => 0)
);
		$this->dbforge->add_column('payroll_additional_compensation', $fields, 'basis');		
	}

	function down() 
	{		
		return TRUE;
	}
}
