<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_office_add_column extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'employee_id' => array('type' => 'VARCHAR (16)', 'null' => FALSE)
						);
						
		$this->dbforge->add_column('office', $fields, 'office_head');		

	}

	function down() 
	{
		
		$this->dbforge->drop_column('office', 'employee_id');
		
	}
}
