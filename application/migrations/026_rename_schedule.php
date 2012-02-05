<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_rename_schedule extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "renaming schedule table to schedule_employees...";
		
		if ( $this->db->table_exists('schedule'))
		{	
			$this->dbforge->rename_table('schedule', 'schedule_employees');
		}

	}

	function down() 
	{
		//$this->migrations->verbose AND print "renaming schedule_employees table to schedule...";
		
		if ( $this->db->table_exists('schedule_employees'))
		{
			$this->dbforge->rename_table('schedule_employees', 'schedule');
		}
		
	}
}
