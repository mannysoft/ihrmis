<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_salary_grade extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "Inserting salary_grade table settings...";
		
		for ( $i = 1; $i != 31; $i++)
		{
			$data = array(
				'sg' 				=> $i,
				'year' 				=> '2011',
				'salary_grade_type' => 'hospital'
				);
		
			$this->db->insert('salary_grade', $data);
		}
		
		

	}

	function down() 
	{
		$this->db->where('salary_grade_type', 'hospital');
		$this->db->delete('salary_grade');
	}
}
