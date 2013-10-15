<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_office_pass_add_column_pass_slip_type extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'pass_slip_type' => array('type' => 'ENUM("Personal","Official")', 'null' => FALSE, 'DEFAULT' => 'Personal')
);
		$this->dbforge->add_column('office_pass', $fields, 'seconds');			
	}

	function down() 
	{		
		return TRUE;
	}
}
