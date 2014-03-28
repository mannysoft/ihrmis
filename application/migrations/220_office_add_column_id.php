<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_office_add_column_id extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'id' => array('type' => 'INT', 'null' => FALSE)
);
		$this->dbforge->add_column('office', $fields, 'office_id');			
	}

	function down() 
	{		
		return TRUE;
	}
}
