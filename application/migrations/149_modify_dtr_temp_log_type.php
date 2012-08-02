<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_dtr_temp_log_type extends CI_Migration {
	
	
	function up() 
	{	
		
		$fields = array(
                        'log_type' => array(
                                                       'name' => 'log_type',
                                                       'type' => 'TINYINT(1) NULL',
                                             ),
		);
		
		$this->dbforge->modify_column('dtr_temp', $fields);

	}

	function down() 
	{
		return TRUE;
	}
}
