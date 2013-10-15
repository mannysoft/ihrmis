<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Change_salary_grade_year extends CI_Migration {
	
	function up() 
	{	
		
		$this->db->where('year', 2010);
		
		$data = array('year' => 2011);
		
		$this->db->update('salary_grade', $data);

	}

	function down() 
	{
		
		
		$this->db->where('year', 2011);
		
		$data = array('year' => 2010);
		
		$this->db->update('salary_grade', $data);
	}
}
