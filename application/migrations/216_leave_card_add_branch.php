<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_leave_card_add_branch extends CI_Migration {
	
	function up() 
	{					
		$fields = array(
                        'branch' => array('type' => 'VARCHAR(64)', 'null' => FALSE, 'DEFAULT' => '')
						
		);
		$this->dbforge->add_column('service_record', $fields, 'office_entity');

		$fields = array(
                        'remarks' => array('type' => 'VARCHAR(64)', 'null' => FALSE, 'DEFAULT' => '')
						
		);
		$this->dbforge->add_column('service_record', $fields, 'branch');
	}

	function down() 
	{		
		return TRUE;
	}
}
