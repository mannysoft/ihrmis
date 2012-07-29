<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_dtr_add_column extends CI_Migration {
	
	function up() 
	{	
		
		$fields = array(
                        'compensatory_timeoff_id' => array('type' => 'INT (16)', 'null' => FALSE)
						);
						
		$this->dbforge->add_column('dtr', $fields, 'office_id');

	}

	function down() 
	{
		
		$this->dbforge->drop_column('dtr', 'compensatory_timeoff_id');
		
	}
}
