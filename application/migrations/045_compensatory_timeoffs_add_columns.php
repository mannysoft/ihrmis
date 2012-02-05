<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_compensatory_timeoffs_add_columns extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "adding compensatory_timeoffs table columns...";
		
		$fields = array(
                        'date_file' => array('type' => 'VARCHAR (16) NOT NULL AFTER dates')
);
		$this->dbforge->add_column('compensatory_timeoffs', $fields);
		
	}

	function down() 
	{
		//$this->migrations->verbose AND print "dropping compensatory_timeoffs table columns...";
		
		$this->dbforge->drop_column('compensatory_timeoffs', 'date_file');
		
		
	}
}
