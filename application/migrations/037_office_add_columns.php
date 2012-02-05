<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_office_add_columns extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "adding employee table columns...";
		
		$fields = array(
                        'office_address' => array('type' => 'VARCHAR (64)', 'null' => FALSE)
);
		$this->dbforge->add_column('office', $fields, 'office_name');
		
	}

	function down() 
	{
		//$this->migrations->verbose AND print "dropping office table columns...";
		
		$this->dbforge->drop_column('office', 'office_address');
		
		
	}
}
