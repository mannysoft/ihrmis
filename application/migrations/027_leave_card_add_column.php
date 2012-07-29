<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_leave_card_add_column extends CI_Migration {
	
	function up() 
	{	
		
		$fields = array(
                        'pass_slip_date' => array('type' => 'DATE', 'null' => FALSE)
						);
						
		$this->dbforge->add_column('leave_card', $fields, 'card_no');		
	}

	function down() 
	{
		
		$this->dbforge->drop_column('leave_card', 'pass_slip_date');
		
	}
}
