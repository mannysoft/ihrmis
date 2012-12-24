<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_office_add_column_disbursing_officer extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'disbursing_officer' => array('type' => 'VARCHAR(32)', 'null' => FALSE, 'DEFAULT' => '')
);
		$this->dbforge->add_column('office', $fields, 'compensatory');
		
	}

	function down() 
	{		
		return TRUE;
	}
}
