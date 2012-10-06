<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_logs_date extends CI_Migration {
	
	
	function up() 
	{	
		
		$fields = array(
                        'date' => array(
                                                       'name' => 'date',
                                                       'type' => 'TIMESTAMP',
                                             ),
		);
		
		$this->dbforge->modify_column('logs', $fields);

	}

	function down() 
	{
		return TRUE;
	}
}
