<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_compensatory_timeoffs_add_columns extends CI_Migration {
	
	function up() 
	{	
				
		$fields = array(
                        'date_file' => array('type' => 'VARCHAR (16)', 'null' => FALSE)
						);
						
		$this->dbforge->add_column('compensatory_timeoffs', $fields, 'dates');		
		
	}

	function down() 
	{
		
		$this->dbforge->drop_column('compensatory_timeoffs', 'date_file');
		
		
	}
}
