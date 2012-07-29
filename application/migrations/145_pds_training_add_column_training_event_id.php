<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_pds_training_add_column_training_event_id extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'training_event_id' => array('type' => 'INT (11)', 'null' => FALSE, 'DEFAULT' => 0)
);
		$this->dbforge->add_column('pds_training', $fields, 'employee_id');		
	}

	function down() 
	{		
		return TRUE;
	}
}
