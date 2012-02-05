<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Change_salary_grade extends CI_Migration {
	
	function up() 
	{	
		//$this->migrations->verbose AND print "changing salary grade entries (year 2010 to 2011)";
		
		$this->db->where('year', 2010);
		
		$data = array('year' => 2011);
		
		$this->db->update('salary_grade', $data);

	}

	function down() 
	{
		
		//$this->migrations->verbose AND print "changing salary grade entries (year 2011 to 2010)";
		
		$this->db->where('year', 2011);
		
		$data = array('year' => 2010);
		
		$this->db->update('salary_grade', $data);
	}
}
