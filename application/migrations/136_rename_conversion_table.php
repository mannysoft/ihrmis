<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_rename_conversion_table extends CI_Migration {
	
	function up() 
	{	
		if ( $this->db->table_exists('conversion_table'))
		{	
			$this->dbforge->rename_table('conversion_table', 'leave_conversion_table');
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('leave_conversion_table'))
		{
			$this->dbforge->rename_table('leave_conversion_table', 'conversion_table');
		}
		
	}
}
