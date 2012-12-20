<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_schedule_details_add_column_office_id extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'office_id' => array('type' => 'INT', 'null' => FALSE, 'DEFAULT' => '0')
);
		$this->dbforge->add_column('schedule_details', $fields, 'schedule_id');			
	}

	function down() 
	{		
		return TRUE;
	}
}
