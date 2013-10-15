<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_compensatory_timeoffs_add_columns_date_file extends CI_Migration {
	
	function up() 
	{	
		
		
		$field = array('date_file' => array('type' => 'VARCHAR (16)', 'null' =>false));	
		
		$this->dbforge->add_column('compensatory_timeoffs', $field, 'dates');
		
	}

	function down() 
	{
		
		$this->dbforge->drop_column('compensatory_timeoffs', 'date_file');
		
		
	}
}
