<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_dtr_add_column_orig_dtr extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'orig_dtr' => array('type' => 'VARCHAR (128)', 'null' => FALSE, 'DEFAULT' => '')
);
		$this->dbforge->add_column('dtr', $fields, 'office_id');		
	}

	function down() 
	{		
		return TRUE;
	}
}
