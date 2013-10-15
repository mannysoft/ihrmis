<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_leave_card_add_column_pass_slip_date extends CI_Migration {
	
	function up() 
	{	
		
		$field = array('pass_slip_date' => array('type' => 'DATE', 'null' =>false));	
		
		$this->dbforge->add_column('leave_card', $field, 'card_no');

	}

	function down() 
	{
		
		$this->dbforge->drop_column('leave_card', 'pass_slip_date');
		
	}
}
