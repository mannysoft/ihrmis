<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_settings extends CI_Migration {
	
	function up() 
	{	
		
		$fields = array(
                        'name' => array(
                                                         'name' => 'name',
                                                         'type' => 'VARCHAR( 64 ) NOT NULL',
                                                ),
					);
					
			$this->dbforge->modify_column('settings', $fields);

	}

	function down() 
	{
	}
}
