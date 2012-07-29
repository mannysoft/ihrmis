<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_drop_column_type_user_table_users extends CI_Migration {
	
	function up() 
	{			
		$this->dbforge->drop_column('users', 'type_user');
		$this->dbforge->drop_column('users', 'pwd');

	}

	function down() 
	{		
		
	}
}
