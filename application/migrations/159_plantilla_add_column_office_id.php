<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_plantilla_add_column_office_id extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'office_id' => array('type' => 'INT (11)', 'null' => FALSE, 'DEFAULT' => 0)
);
		$this->dbforge->add_column('plantilla', $fields, 'employee_id');		
	}

	function down() 
	{		
		return TRUE;
	}
}
