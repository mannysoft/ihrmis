<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_division_add_columns_order extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'order' => array('type' => 'INT (2)', 'null' => FALSE)
);
		$this->dbforge->add_column('divisions', $fields, 'office_id');
		
	}

	function down() 
	{		
		$this->dbforge->drop_column('divisions', 'order');
		
		
	}
}
