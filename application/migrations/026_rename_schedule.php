<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_rename_schedule extends CI_Migration {
	
	function up() 
	{	
		
		if ( $this->db->table_exists('schedule'))
		{	
			$this->dbforge->rename_table('schedule', 'schedule_employees');
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('schedule_employees'))
		{
			$this->dbforge->rename_table('schedule_employees', 'schedule');
		}
		
	}
}
