<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_rename_compensatory_timeoff extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "renaming compensatory_timeoff table to compensatory_timeoffs...";
		
		if ( $this->db->table_exists('compensatory_timeoff'))
		{	
			$this->dbforge->rename_table('compensatory_timeoff', 'compensatory_timeoffs');
		}

	}

	function down() 
	{
		//$this->migrations->verbose AND print "renaming compensatory_timeoffs table to compensatory_timeoff...";
		
		if ( $this->db->table_exists('compensatory_timeoffs'))
		{
			$this->dbforge->rename_table('compensatory_timeoffs', 'compensatory_timeoff');
		}
		
	}
}
