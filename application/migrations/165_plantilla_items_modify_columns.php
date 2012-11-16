<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_plantilla_items_modify_columns extends CI_Migration {
	
	function up() 
	{	
		
		$fields = array(
                        'description' => array(
                                                         'name' => 'position_title',
                                                         'type' => 'VARCHAR (64) NOT NULL',
                                                ),
		);
		
		$this->dbforge->modify_column('plantilla_items', $fields);

	}

	function down() 
	{
		return TRUE;
	}
}
