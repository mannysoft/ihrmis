<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_forwarded_leave extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "modifying forwarded_leave table...";
				
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
		//$this->migrations->verbose AND print "modify forwarded_leave...";
	}
}
