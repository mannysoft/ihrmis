<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_logs_table_username extends CI_Migration {
	
	function up() 
	{	
		
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
		
		$fields = array(
                        'username' => array(
                                                         'name' => 'username',
                                                         'type' => 'VARCHAR(10) NOT NULL',
                                                ),
);
		$this->dbforge->modify_column('logs', $fields);	
	}
}
