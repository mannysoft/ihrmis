<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Training_course extends DataMapper{

	//var $table  = 'training_course';
	
	public $has_one = array("training_type");
	
	// --------------------------------------------------------------------
	
	
	function __construct()
	{
		parent::__construct();
		
		//$this->load->helper('security');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Options for divisions
	 *
	 * @param boolean $add_select
	 * @return array
	 */
	function courses($office_id = 1)
	{
		$options  = array();
		$this->where('course_title !=', '');
		//$courses = $this->order_by('course_title')->limit(10)->get();
		$courses = $this->order_by('course_title')->get();
						
		foreach($courses as $course)
		{
			$options[$course->id] = $course->course_title;
		}
		
		return $options;
	}
	
	// --------------------------------------------------------------------
	
}

/* End of file user.php */
/* Location: ./application/models/pages.php */