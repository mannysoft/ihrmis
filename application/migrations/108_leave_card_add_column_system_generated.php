<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_leave_card_add_column_system_generated extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'forced_leave_system_generated' => 
								array(
									'type' 		=> 'ENUM ("no", "yes")', 
									'DEFAULT' 	=> 'no', 
									'COMMENT' 	=> 'use this to know if forced leave is system generated')
);
		$this->dbforge->add_column('leave_card', $fields, 'enabled');
				
	}

	function down() 
	{		
		$this->dbforge->drop_column('leave_card', 'forced_leave_system_generated');		
	}
}
