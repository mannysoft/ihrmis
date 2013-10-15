<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_rename_compensatory_timeoff extends CI_Migration {
	
	function up() 
	{	
		
		//if ( $this->db->table_exists('compensatory_timeoff'))
		//{	
			$this->dbforge->rename_table('compensatory_timeoff', 'compensatory_timeoffs');
		//}

	}

	function down() 
	{
		
		if ( $this->db->table_exists('compensatory_timeoffs'))
		{
			$this->dbforge->rename_table('compensatory_timeoffs', 'compensatory_timeoff');
		}
		
	}
}
