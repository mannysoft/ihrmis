<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Education extends DataMapper{

	var $table  = 'pds_education_background';
	
	// --------------------------------------------------------------------
	
	
	function __construct()
	{
		parent::__construct();
		
		//$this->load->helper('security');
	}
	
	// --------------------------------------------------------------------
	function get_single_educ($employee_id, $level)
	{
		$data = array();
		
		$e =  new Education();
		
		$e->where('employee_id', $employee_id);
		$e->where('level', $level);
		$e->get();
		
		return $e;
		
		/*
		$this->db->where('employee_id', $employee_id);
		$this->db->where('level', $level);
		$this->db->order_by('level');
		$q = $this->db->get('education_background');
		
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row;
			}
		}
	
		return $data;
		
		$q->free_result();
		*/
	}
	
}

/* End of file user.php */
/* Location: ./application/models/pages.php */