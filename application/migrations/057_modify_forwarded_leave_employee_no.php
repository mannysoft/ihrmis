<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_forwarded_leave_employee_no extends CI_Migration {
	
	function up() 
	{	
				
		if ($this->db->field_exists('employee_no', 'forwarded_leave'))
		{
		   $fields = array(
                        'employee_no' => array(
                                                         'name' => 'employee_id',
                                                         'type' => 'VARCHAR( 20 ) NOT NULL',
                                                ),
					);
					
			$this->dbforge->modify_column('forwarded_leave', $fields);
		} 
		
	}

	function down() 
	{
	}
}
