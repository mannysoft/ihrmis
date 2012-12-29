<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_philhealth_sched extends CI_Migration {
	
	
	function up() 
	{	
		
		$fields = array(
                        'start_range' => array('type' => 'DOUBLE', 'null' => FALSE),
						'end_range' => array('type' => 'DOUBLE', 'null' => FALSE)
		);
		
		$this->dbforge->modify_column('payroll_philhealth_schedules', $fields);
	}

	function down() 
	{
		return TRUE;
	}
}
