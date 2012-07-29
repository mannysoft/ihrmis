<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question extends DataMapper{

	var $table  = 'pds_questions';
	
	// --------------------------------------------------------------------
	
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	// --------------------------------------------------------------------
	
	function get_question($employee_id, $question_no = '')
	{
		$data = array();
		
		$q = new Question();
		
		$q->where('employee_id', $employee_id);
		$q->where('question_no', $question_no);
		$q->order_by('question_no');
		$q->get();
		
		return $q;
		
	}
	
	// --------------------------------------------------------------------
	
}

/* End of file user.php */
/* Location: ./application/models/pages.php */