<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_philhealth_schedules_add_column_salary_bracket extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'salary_bracket' => array('type' => 'INT (2)', 'null' => FALSE, 'DEFAULT' => 0)
);
		$this->dbforge->add_column('payroll_philhealth_schedules', $fields, 'id');		
	}

	function down() 
	{		
		return TRUE;
	}
}
