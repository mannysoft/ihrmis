<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_logs_add_column_module extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'module' => array('type' => 'VARCHAR (32)', 'null' => FALSE, 'DEFAULT' => '')
);
		$this->dbforge->add_column('logs', $fields, 'command');		
	}

	function down() 
	{		
		return TRUE;
	}
}
