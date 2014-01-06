<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Integrated Human Resource Management Information System
 *
 * An Open Source Application Software use by Government agencies for  
 * management of employees Attendance, Leave Administration, Payroll, 
 * Personnel Training, Service Records, Performance, Recruitment,
 * Personnel Schedule(Plantilla) and more...
 *
 * @package		iHRMIS
 * @author		Manny Isles
 * @copyright	Copyright (c) 2008 - 2013, Charliesoft
 * @license		http://charliesoft.net/ihrmis/license
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * iHRMIS Conversion Table Class
 *
 * This class use for converting number of minutes late
 * to the corresponding equivalent to leave credits.
 *
 * @package		iHRMIS
 * @subpackage	Models
 * @category	Models
 * @author		Manny Isles
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis/hrmis/user_guide/models/conversion_table.html
 */
class Training_manage extends MX_Controller {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		//$this->output->enable_profiler(TRUE);
    }  
	
	// --------------------------------------------------------------------
	
	function type()
	{
		$data['page_name'] = '<b>Training Type</b>';
		
		$data['msg'] = '';
		
		$this->load->library('pagination');
		
		$type = new Training_type();
		
		$config['base_url'] = base_url().'training_manage/type';
		$config['total_rows'] = $type->get()->count();
		$config['per_page'] = '15';
		$this->config->load('pagination', TRUE);
		
		$pagination = $this->config->item('pagination');
		
		// We will merge the config file of pagination
		$config = array_merge($config, $pagination);
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		$type->order_by('training_type');
		
		$data['rows'] = $type->get($limit, $offset);
		
		$data['page'] = $this->uri->segment(3);
		
		$data['main_content'] = 'type';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function type_save( $id = '', $page = '' )
	{
		$data['page_name'] = '<b>Save Training Type</b>';
		
		$data['msg'] = '';
		
		$this->load->helper('list_box');
		
		$type = new Training_type();
		
		$data['type'] = $type->get_by_id( $id );
		
		if(Input::get('op'))
		{
			$type->training_type 		= Input::get('training_type');
			$type->training_type_desc 	= Input::get('training_type_desc');
			
			$type->save();
			
			Session::flash('msg', 'Training Type saved!');
			
			return Redirect::to('training_manage/type/'.$page, 'refresh');
		}
		
		$data['main_content'] = 'type_save';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function type_delete( $id = '', $page = '' )
	{
		$type = new Training_type();
		
		$type->get_by_id( $id );
		
		$type->delete();
		
		Session::flash('msg', 'Training Type Deleted!');
		
		return Redirect::to('training_manage/type/'.$page, 'refresh');
		
	}
	
	// --------------------------------------------------------------------
	
	function course()
	{
		$data['page_name'] = '<b>Training Course</b>';
		
		$data['msg'] = '';
		
		$this->load->library('pagination');
		
		$course = new Training_course();
		
		$config['base_url'] = base_url().'training_manage/course';
		$config['total_rows'] = $course->count();
		$config['per_page'] = '15';
		$this->config->load('pagination', TRUE);
		
		$pagination = $this->config->item('pagination');
		
		// We will merge the config file of pagination
		$config = array_merge($config, $pagination);
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		$course->order_by('course_title');
		
		if (Input::get('training_type_id') != 0)
		{
			$course->where('training_type_id', Input::get('training_type_id'));
		}
		
		$data['rows'] = $course->get($limit, $offset);
		
		$data['page'] = $this->uri->segment(3);
				
		$data['main_content'] = 'course';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function course_save( $id = '', $page = '' )
	{
		$data['page_name'] = '<b>Save Training Course</b>';
		
		$data['msg'] = '';
		
		$this->load->helper('list_box');
		
		$course = new Training_course();
		
		$data['course'] = $course->get_by_id( $id );
		
		if(Input::get('op'))
		{
			$course->training_type_id 		= Input::get('training_type_id');
			$course->course_title 			= Input::get('course_title');
			$course->course_description 	= Input::get('course_description');
			$course->course_est_duration 	= Input::get('course_est_duration');
			$course->course_est_cost 		= Input::get('course_est_cost');
			$course->course_ave_eval 		= Input::get('course_ave_eval');
			
			$course->save();
			
			Session::flash('msg', 'Training Course saved!');
			
			return Redirect::to('training_manage/course/'.$page, 'refresh');
		}
		
		$data['selected'] = $course->training_type_id;
		
		$data['main_content'] = 'course_save';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function course_delete( $id = '', $page = '' )
	{
		$course = new Training_course();
		
		$course->get_by_id( $id );
		
		$course->delete();
		
		Session::flash('msg', 'Training Course Deleted!');
		
		return Redirect::to('training_manage/course/'.$page, 'refresh');
		
	}
	
	// --------------------------------------------------------------------
	
	function event()
	{
		$data['page_name'] = '<b>Training Event</b>';
		
		$data['msg'] = '';
		
		$this->load->library('pagination');
		
		$event = new Training_event();
		
		$config['base_url'] = base_url().'training_manage/event';
		$config['total_rows'] = $event->get()->count();
		$config['per_page'] = '15';
		$this->config->load('pagination', TRUE);
		
		$pagination = $this->config->item('pagination');
		
		// We will merge the config file of pagination
		$config = array_merge($config, $pagination);
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		$event->order_by('event_from', 'DESC');
		
		$data['rows'] = $event->get($limit, $offset);
		
		$data['page'] = $this->uri->segment(3);
		
		$data['main_content'] = 'event';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function event_save( $id = '', $page = '' )
	{
		$data['page_name'] = '<b>Save Training Event</b>';
		
		$data['msg'] = '';
		
		$this->load->helper('list_box');
		
		$event = new Training_event();
		
		$data['event'] = $event->get_by_id( $id );
		
		if(Input::get('op'))
		{
			$event->course_id 			= Input::get('course_id');
			$event->event_from 			= Input::get('event_from');
			$event->event_to 			= Input::get('event_from');
			$event->event_venue 		= Input::get('event_venue');
			$event->contact_id 			= Input::get('contact_id');
			//$event->funder_id 			= Input::get('funder_id');
			$event->event_local_cost 	= Input::get('event_local_cost');
			$event->event_other_cost 	= Input::get('event_other_cost');
			$event->event_duration 		= Input::get('event_duration');
			$event->event_eval 			= Input::get('event_eval');
			$event->remarks 			= Input::get('remarks');
			
			$event->save();
			
			Session::flash('msg', 'Training Event saved!');
			
			return Redirect::to('training_manage/event/'.$page, 'refresh');
		}
		
		$data['selected'] 				= $event->course_id;
		
		$data['contact_id_selected'] 	= $event->contact_id;
		
		$data['main_content'] = 'event_save';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function event_delete( $id = '', $page = '' )
	{
		$event = new Training_event();
		
		$event->get_by_id( $id );
		
		$event->delete();
		
		Session::flash('msg', 'Training Event Deleted!');
		
		return Redirect::to('training_manage/event/'.$page, 'refresh');
		
	}
	
	// --------------------------------------------------------------------
	
	function attendance($event_id = '')
	{
		
		$data['page_name'] = '<b>Training Attendance</b>';
		
		$data['msg'] = '';
		
		$event_id  = (Input::get('event_id')) ? Input::get('event_id') : $event_id;
		
		$this->load->helper('list_box');
		$this->load->library('pagination');
		
		$attend = new Training_attendee();
		
		if ( Input::get('btn_save'))
		{
			$attend->get_by_id(Input::get('id'));
			$attend->event_id 				= $event_id;
			$attend->employee_id 			= Input::get('employee_id');
			$attend->employee_local_cost 	= Input::get('employee_local_cost');
			$attend->employee_other_cost 	= Input::get('employee_other_cost');
			$attend->relevant 				= Input::get('relevant');
			$attend->certified 				= Input::get('certified');
			$attend->remarks 				= Input::get('remarks');
			
			$attend->save();
			
			// Lets save also the data to employee
		}
		
		$attend->order_by('id');
		
		$data['rows'] = $attend->get_by_event_id($event_id);
		
		$data['page'] = $this->uri->segment(3);
		$data['event_id'] = $event_id;
		
		$data['main_content'] = 'attendance';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function attendance_save( $id = '', $page = '' )
	{
		$data['page_name'] = '<b>Save Training Attendance</b>';
		
		$data['msg'] = '';
		
		$this->load->helper('list_box');
		
		$attendance = new Training_attendee();
		
		$data['attendance'] = $attendance->get_by_id( $id );
		
		if(Input::get('op'))
		{
			$event->course_id 			= Input::get('course_id');
			$event->event_from 			= Input::get('event_from');
			$event->event_to 			= Input::get('event_from');
			$event->event_venue 		= Input::get('event_venue');
			$event->contact_id 			= Input::get('contact_id');
			//$event->funder_id 			= Input::get('funder_id');
			$event->event_local_cost 	= Input::get('event_local_cost');
			$event->event_other_cost 	= Input::get('event_other_cost');
			$event->event_duration 		= Input::get('event_duration');
			$event->event_eval 			= Input::get('event_eval');
			$event->remarks 			= Input::get('remarks');
			
			$event->save();
			
			Session::flash('msg', 'Training Attendance saved!');
			
			return Redirect::to('training_manage/attendance/'.$page, 'refresh');
		}
		
		$data['selected'] 				= $attendance->course_id;
		
		$data['contact_id_selected'] 	= $attendance->contact_id;
		
		$data['main_content'] = 'attendance_save';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function attendance_delete( $id = '', $page = '' )
	{
		$event = new Training_attendee();
		
		$event->get_by_id( $id );
		
		$event->delete();		
	}
	
	// --------------------------------------------------------------------
	
	function contact_type()
	{
		$data['page_name'] = '<b>Training Contact Type</b>';
		
		$data['msg'] = '';
		
		$this->load->library('pagination');
		
		$contact = new Training_contact_type();
		
		$config['base_url'] = base_url().'training_manage/contact_type';
		$config['total_rows'] = $contact->get()->count();
		$config['per_page'] = '15';
		$config['full_tag_open'] = '<p>';
	    $config['full_tag_close'] = '</p>';
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		$contact->order_by('contact_type');
		
		$data['rows'] = $contact->get($limit, $offset);
		
		$data['page'] = $this->uri->segment(3);
		
		$data['main_content'] = 'contact_type';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function contact_type_save( $id = '', $page = '' )
	{
		$data['page_name'] = '<b>Save Training Contact Type</b>';
		
		$data['msg'] = '';
		
		$this->load->helper('list_box');
		
		$contact = new Training_contact_type();
		
		$data['contact'] = $contact->get_by_id( $id );
		
		if(Input::get('op'))
		{
			$contact->contact_type		= Input::get('contact_type');
			$contact->contact_type_desc = Input::get('contact_type_desc');
			
			$contact->save();
			
			Session::flash('msg', 'Training Contact Type saved!');
			
			return Redirect::to('training_manage/contact_type/'.$page, 'refresh');
		}
		
		$data['main_content'] = 'contact_type_save';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function contact_type_delete( $id = '', $page = '' )
	{
		$contact = new Training_contact_type();
		
		$contact->get_by_id( $id );
		
		$contact->delete();
		
		Session::flash('msg', 'Training Contact Type Deleted!');
		
		return Redirect::to('training_manage/contact_type/'.$page, 'refresh');
		
	}
	
	// --------------------------------------------------------------------
	
	function contact_info()
	{
		$data['page_name'] = '<b>Training Contact Information</b>';
		
		$data['msg'] = '';
		
		$this->load->library('pagination');
		
		$contact = new Training_contact();
		
		$config['base_url'] = base_url().'training_manage/contact_info';
		$config['total_rows'] = $contact->get()->count();
		$config['per_page'] = '15';
		$this->config->load('pagination', TRUE);
		
		$pagination = $this->config->item('pagination');
		
		// We will merge the config file of pagination
		$config = array_merge($config, $pagination);
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		$contact->order_by('contact_name');
		
		if (Input::get('contact_type_id') != 0)
		{
			$contact->where('contact_type_id', Input::get('contact_type_id'));
			//$limit = '';
		}
		
		$data['rows'] = $contact->get($limit, $offset);
		
		$data['page'] = $this->uri->segment(3);
		
		$data['main_content'] = 'contact_info';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function contact_info_save( $id = '', $page = '' )
	{
		$data['page_name'] = '<b>Save Training Contact Information</b>';
		
		$data['msg'] = '';
		
		$this->load->helper('list_box');
		
		$contact = new Training_contact();
		
		$data['contact'] = $contact->get_by_id( $id );
		
		if(Input::get('op'))
		{
			$contact->contact_name 		= Input::get('contact_name');
			$contact->contact_co 		= Input::get('contact_co');
			$contact->contact_address 	= Input::get('contact_address');
			$contact->contact_city 		= Input::get('contact_city');
			$contact->contact_phone 	= Input::get('contact_phone');
			$contact->contact_fax 		= Input::get('contact_fax');
			$contact->contact_email 	= Input::get('contact_email');
			$contact->contact_specialty = Input::get('contact_specialty');
			$contact->contact_type_id 	= Input::get('contact_type_id');
			
			$contact->save();
			
			Session::flash('msg', 'Training Contact Information saved!');
			
			return Redirect::to('training_manage/contact_info/'.$page, 'refresh');
		}
		
		$data['selected'] 	= $contact->contact_type_id;
		
		$data['main_content'] = 'contact_info_save';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function contact_info_delete( $id = '', $page = '' )
	{
		$contact = new Training_contact();
		
		$contact->get_by_id( $id );
		
		$contact->delete();
		
		Session::flash('msg', 'Training Contact Information Deleted!');
		
		return Redirect::to('training_manage/contact_info/'.$page, 'refresh');
		
	}
	
	// --------------------------------------------------------------------
	
	function employees( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Employee\'s Training Record</b>';
				
		$data['focus_field']		= 'tra_name';
		
		$data['msg'] 				= '';
		
		$employee_id = Input::get('employee_id');
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id (Input::get('employee_id'));
		
		$data['pics'] = (file_exists('pics/'.$e->pics)) ? $e->pics : 'not_available.jpg';
		
		$image_properties = array(
          'src' => base_url().'pics/'.$data['pics'],
          'width' => '140',
          'height' => '140',
		);
		
		$data['pics'] = $image_properties;
				
		$em = new Employee_movement_m();
		$em->get_by_id($e->employee_movement_id);
		
		$data['employment_movement'] = $em->employee_movement;
		
		if ( Input::get('op'))
		{
			// TRAINING PROGRAMS=========================
			$tra_name 		= Input::get('tra_name');
			$tra_date_from 	= Input::get('tra_date_from');
			$tra_date_to 	= Input::get('tra_date_to');
			$tra_hours 		= Input::get('tra_hours');
			$tra_conduct 	= Input::get('tra_conduct');
			$tra_location 	= Input::get('tra_location');
			
			$t = new Training();
			
			$t->get_by_employee_id( $employee_id );
			
			$t->delete_all();
			
			$i = 0;
			
			foreach ($tra_name as $tra)
			{
				if ($tra != "")
				{
					$t = new Training();
					
					$t->employee_id 	= $employee_id;
					$t->name 			= $tra_name[$i];
					$t->date_from 		= $tra_date_from[$i];
					$t->date_to 		= $tra_date_to[$i];
					$t->number_hours	= $tra_hours[$i];
					$t->conducted_by	= $tra_conduct[$i];
					$t->location		= $tra_location[$i];

					$t->save();
				
				}
				
				$i++;
			}
			
			$data['msg'] = 'Trainings has been saved!';
						
		}
		
		// Recommended trainings
		if ( Input::get('op2'))
		{
			$recommends = Input::get('recommend_id');
			
			$reco_year 		= Input::get('reco_year');
			$course_id 		= Input::get('course_id');
			$relevant 		= Input::get('relevant');
			$reco_remarks 	= Input::get('reco_remarks');
			
			$i = 0;
			
			foreach ($recommends as $r_id)
			{
				if ($reco_year[$i] != '')
				{
					$t = new Training_recomended_m();
					$t->where('course_id', $course_id[$i]);
					$t->where('reco_year', $reco_year[$i]);
					$t->where('employee_id', $employee_id);
					$t->get();
					
					$t->employee_id 	= $employee_id;
					$t->reco_year 		= $reco_year[$i];
					$t->course_id 		= $course_id[$i];
					$t->relevant 		= $relevant[$i];
					$t->reco_remarks 	= $reco_remarks[$i];
					
					$t->save();
				}
				
				$i ++;
				
			}
			
			// Remove checked
			if (Input::get('remove'))
			{
				foreach (Input::get('remove') as $recommended_id)
				{
					$t = new Training_recomended_m();
					$t->get_by_id($recommended_id);
					$t->delete();
				}
			}
			
						
		}
		
		// Actual duties
		if ( Input::get('op3'))
		{
			$duties_ids = Input::get('duties_id');
			
			$duty_from 		= Input::get('duty_from');
			$duty_to 		= Input::get('duty_to');
			$duty_desc 		= Input::get('duty_desc');
			
			$i = 0;
			
			foreach ($duties_ids as $r_id)
			{
				if ($duty_from[$i] != '')
				{
					$ed = new Employee_duty_m();
					$ed->get_by_id($r_id);
					$ed->employee_id 	= $employee_id;
					$ed->duty_from 		= $duty_from[$i];
					$ed->duty_to 		= $duty_to[$i];
					$ed->duty_desc 		= $duty_desc[$i];
					
					$ed->save();
					
				}
				
				$i ++;
				
			}	
						
		}
		
		// Training===========================================================
		
		$t = new Training();
		
		$t->order_by('date_from', 'DESC');
		
		$data['trains'] = $t->get_by_employee_id($employee_id);
		$data['tra_location_options'] = array(
										  'local'  			=> 'Local',
										  'regional'  		=> 'Regional',
										  'national'		=> 'National',
										  'international'	=> 'International'
										);
		
		if ($employee_id == '')
		{
			$data['trains'] = array();
		}
		
		// Recommended Trainings
		$t  = new Training_recomended_m();
		$t->order_by('reco_year');
		$data['recommends'] = $t->get_by_employee_id($employee_id);
		
		// Actual Duties
		$ed = new Employee_duty_m();
		$ed->order_by('duty_from');
		$data['duties'] = $ed->get_by_employee_id($employee_id);

		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		// Courses
		$t = new Training_course();
		$data['courses'] = $t->courses();	
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'employees';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	
}	

/* End of file training_manage.php */
/* Location: ./system/application/modules/training_manage/controllers/training_manage.php */