<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_leave_card_add_column extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "adding colum to leave_card table...";
		
		$fields = array(
                        'pass_slip_date' => array('type' => 'DATE NOT NULL AFTER `card_no`')
						);
						
		$this->dbforge->add_column('leave_card', $fields);

	}

	function down() 
	{
		//$this->migrations->verbose AND print "dropping column pass_slip_date from leave_card...";
		
		$this->dbforge->drop_column('leave_card', 'pass_slip_date');
		
	}
}
