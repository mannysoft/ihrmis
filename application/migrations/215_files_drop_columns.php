<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_files_drop_columns extends CI_Migration {
	
	function up() 
	{	
		$this->dbforge->drop_column('files', 'created_at');
		$this->dbforge->drop_column('files', 'updated_at');
		$this->dbforge->drop_column('files', 'deleted_at');
	}

	function down() 
	{
		
	}
}
