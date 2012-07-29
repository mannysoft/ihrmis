<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_drop_column_office_code extends CI_Migration {
	
	function up() 
	{			
		$this->dbforge->drop_column('users', 'office_code');

	}

	function down() 
	{		
		
	}
}
