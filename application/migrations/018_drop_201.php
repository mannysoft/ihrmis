<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_drop_201 extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "dropping 201 table...";
		
		if (  $this->db->table_exists('201'))
		{
			$this->dbforge->drop_table('201');
		}
		
		
		
	}

	function down() 
	{
		//$this->migrations->verbose AND print "creating 201 table...";
		
		//$this->dbforge->drop_column('employee', 'birth_date');
		//$this->dbforge->drop_column('employee', 'res_address');
		
		
	}
}
