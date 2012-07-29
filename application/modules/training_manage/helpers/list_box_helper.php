<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// --------------------------------------------------------------------

if ( ! function_exists('training_type'))
{
	function training_type()
	{
		$t = new Training_type();
		
		$t->order_by('training_type');
		
		$types = $t->get();
		
		foreach ( $types as $type)
		{
			$options[$type->id] = $type->training_type;
		}
		
		return $options;
	}
}

// --------------------------------------------------------------------

if ( ! function_exists('training_course'))
{
	function training_course()
	{
		$ci = &  get_instance();
		
		$t = new Training_course();
		
		$t->order_by('course_title');
		
		$types = $t->get();
		
		$ci->load->helper('text');
		
		foreach ( $types as $type)
		{
			//$options[$type->id] = word_limiter($type->course_title, 8);
			$options[$type->id] = $type->course_title;
		}
		
		return $options;
	}
}

// --------------------------------------------------------------------

if ( ! function_exists('training_contact'))
{
	function training_contact()
	{
		$ci = &  get_instance();
		
		$t = new Training_contact();
		
		$t->order_by('contact_name');
		
		$types = $t->get();
		
		$ci->load->helper('text');
		
		foreach ( $types as $type)
		{
			$options[$type->id] = $type->contact_name;
		}
		
		return $options;
	}
}

// --------------------------------------------------------------------

if ( ! function_exists('training_contact_type'))
{
	function training_contact_type()
	{
		$ci = &  get_instance();
		
		$t = new training_contact_type();
		
		$t->order_by('contact_type');
		
		$types = $t->get();
		
		$ci->load->helper('text');
		
		foreach ( $types as $type)
		{
			$options[$type->id] = $type->contact_type;
		}
		
		return $options;
	}
}

// --------------------------------------------------------------------

if ( ! function_exists('training_event'))
{
	function training_event()
	{
		$ci = &  get_instance();
		
		$t = new Training_event();
		
		$t->order_by('event_from', 'DESC');
		
		$types = $t->get();
		
		$ci->load->helper('text');
		
		foreach ( $types as $type)
		{
			$tc = new Training_course();
			$tc->get_by_id($type->course_id);
			$options[$type->id] = $type->event_from."\t \t | ".$type->event_to."\t \t | ".$tc->course_title;
		}
		
		return $options;
	}
}

// --------------------------------------------------------------------

if ( ! function_exists('training_employees'))
{
	function training_employees()
	{
		$ci = &  get_instance();
		
		$e = new Employee_m();
		$e->where('lname !=', '');
		$e->where('status', 1);
		
		$e->order_by('lname');
		
		$types = $e->get();
		
		$ci->load->helper('text');
		
		foreach ( $types as $type)
		{
			$options[$type->id] = $type->lname.', '.$type->fname.' '.$type->mname;
		}
		
		return $options;
	}
}


/* End of file loading_helper.php */
/* Location: ./application/modules/payroll_deductions/loading_helper.php */