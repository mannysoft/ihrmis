<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_drop_revision_table extends CI_Migration {
	
	function up() 
	{	
		
		if (  $this->db->table_exists('revision'))
		{
			$this->dbforge->drop_table('revision');
		}
		
		if (  $this->db->table_exists('agency'))
		{
			$this->dbforge->drop_table('agency');
		}
		
		if (  $this->db->table_exists('clients'))
		{
			$this->dbforge->drop_table('clients');
		}
		
		
		
	}

	function down() 
	{
		return TRUE;		
	}
}
