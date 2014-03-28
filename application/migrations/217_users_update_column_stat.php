<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_users_update_column_stat extends CI_Migration {
	
	function up() 
	{			
		$fields = array(
                        'stat' => array(
                                                         'name' => 'stat',
                                                         'type' => 'ENUM ("Active", "Inactive")',
                                                ),
		);
		
		$this->dbforge->modify_column('users', $fields);
	}

	function down() 
	{		
		return TRUE;
	}
}
