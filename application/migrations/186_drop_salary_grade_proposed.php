<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_drop_salary_grade_proposed extends CI_Migration {
	
	function up() 
	{	
		if ( $this->db->table_exists('salary_grade_proposed'))
		{
			$this->dbforge->drop_table('salary_grade_proposed');
		}
	}

	function down() 
	{
		return TRUE;		
	}
}
