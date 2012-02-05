<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_office_add_column extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "adding colum to office table...";
		
		$fields = array(
                        'account_no' => array('type' => 'VARCHAR (16)', 'null' => FALSE),
						
						);
						
		$this->dbforge->add_column('office', $fields, 'office_name');
		
		$fields = array(
						'program' => array('type' => 'VARCHAR (512)' , 'null' => FALSE),
						);
						
		$this->dbforge->add_column('office', $fields, 'account_no');


	}

	function down() 
	{
		//$this->migrations->verbose AND print "dropping column pass_slip_date from office...";
		
		$this->dbforge->drop_column('office', 'account_no');
		$this->dbforge->drop_column('office', 'program');
		
	}
}
