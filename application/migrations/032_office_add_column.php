<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_office_add_column extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "adding colum to office table...";
		
		$fields = array(
                        'employee_id' => array('type' => 'VARCHAR (16) NOT NULL AFTER `office_head`')
						);
						
		$this->dbforge->add_column('office', $fields);

	}

	function down() 
	{
		//$this->migrations->verbose AND print "dropping column pass_slip_date from office...";
		
		$this->dbforge->drop_column('office', 'employee_id');
		
	}
}
