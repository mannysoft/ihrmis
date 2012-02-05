<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Alter_settings extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "altering settings table...Adding column description";
		
		$fields = array(
                        'description' => array('type' => 'TEXT NOT NULL')
						);
						
		$this->dbforge->add_column('settings', $fields);

	}

	function down() 
	{
		
		//$this->migrations->verbose AND print "altering settings table...Dropping column description";
		
		$this->dbforge->drop_column('settings', 'description');
	}
}
