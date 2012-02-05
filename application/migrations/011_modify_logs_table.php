<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_logs_table extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "modifying logs table...";
		
		$fields = array(
                        'username' => array(
                                                         'name' => 'username',
                                                         'type' => 'VARCHAR(32)',
														 'null'	=> FALSE,
                                                ),
);
		$this->dbforge->modify_column('logs', $fields);	
		
		

	}

	function down() 
	{
		//$this->migrations->verbose AND print "modifying logs table...";
		
		$fields = array(
                        'username' => array(
                                                         'name' => 'username',
                                                         'type' => 'VARCHAR(10) NOT NULL',
                                                ),
);
		$this->dbforge->modify_column('logs', $fields);	
	}
}
