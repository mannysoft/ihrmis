<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_leave_card_add_column_max_leave_date extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'max_leave_date' => array('type' => 'DATE', 'null' => FALSE, 'DEFAULT' => '0000-00-00')
);
		$this->dbforge->add_column('leave_card', $fields, 'date');		
	}

	function down() 
	{		
		return TRUE;
	}
}
