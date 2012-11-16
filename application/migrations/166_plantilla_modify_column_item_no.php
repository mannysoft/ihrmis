<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_plantilla_modify_column_item_no extends CI_Migration {
	
	function up() 
	{	
		
		$fields = array(
                        'item_no' => array(
                                                         'name' => 'plantilla_item_id',
                                                         'type' => 'INT (11) NOT NULL',
                                                ),
		);
		
		$this->dbforge->modify_column('plantilla', $fields);

	}

	function down() 
	{
		return TRUE;
	}
}
