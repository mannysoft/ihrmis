<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_drop_new_settings_table extends CI_Migration {
	
	function up() 
	{	
		if ( $this->db->table_exists('new_settings'))
		{
			$this->dbforge->drop_table('new_settings');
		}
	}

	function down() 
	{
		return TRUE;		
	}
}
