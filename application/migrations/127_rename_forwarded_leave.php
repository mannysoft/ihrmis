<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_rename_forwarded_leave extends CI_Migration {
	
	function up() 
	{	
		
		if ( $this->db->table_exists('forwarded_leave'))
		{	
			$this->dbforge->rename_table('forwarded_leave', 'leave_forwarded');
		}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('leave_forwarded'))
		{
			$this->dbforge->rename_table('leave_forwarded', 'forwarded_leave');
		}
		
	}
}
