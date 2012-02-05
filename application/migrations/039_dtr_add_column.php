<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_dtr_add_column extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "adding column compensatory_timeoff_id to dtr table...";
		
		$fields = array(
                        'compensatory_timeoff_id' => array('type' => 'INT (16)', 'null' => FALSE)
						);
						
		$this->dbforge->add_column('dtr', $fields, 'office_id');

	}

	function down() 
	{
		//$this->migrations->verbose AND print "dropping column compensatory_timeoff_id from dtr...";
		
		$this->dbforge->drop_column('dtr', 'compensatory_timeoff_id');
		
	}
}
