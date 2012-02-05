<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Training_manage extends MX_Controller {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		//$this->output->enable_profiler(TRUE);
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
		$config['full_tag_open'] = '<p>';
	    $config['full_tag_close'] = '</p>';
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		$course->order_by('course_title');
		
		$data['rows'] = $course->get($limit, $offset);
		
		$data['page'] = $this->uri->segment(3);
				
		$data['main_content'] = 'course';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function course_save( $id = '', $page = '' )
	{
		$data['page_name'] = '<b>Save Training Course</b>';
		
		$data['msg'] = '';
		
		$this->load->helper('list_box');
		
		$course = new Training_course();
		
		$data['course'] = $course->get_by_id( $id );
		
		if($this->input->post('op'))
		{
			$course->training_type_id 		= $this->input->post('training_type_id');
			$course->course_title 			= $this->input->post('course_title');
			$course->course_description 	= $this->input->post('course_description');
			$course->course_est_duration 	= $this->input->post('course_est_duration');
			$course->course_est_cost 		= $this->input->post('course_est_cost');
			$course->course_ave_eval 		= $this->input->post('course_ave_eval');
			
			$course->save();
			
			$this->session->set_flashdata('msg', 'Training Course saved!');
			
			redirect(base_url().'training_manage/course/'.$page, 'refresh');
		}
		
		$data['selected'] = $course->training_type_id;
		
		$data['main_content'] = 'course_save';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function course_delete( $id = '', $page = '' )
	{
		$course = new Training_course();
		
		$course->get_by_id( $id );
		
		$course->delete();
		
		$this->session->set_flashdata('msg', 'Training Course Deleted!');
		
		redirect(base_url().'training_manage/course/'.$page, 'refresh');
		
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
		$config['full_tag_open'] = '<p>';
	    $config['full_tag_close'] = '</p>';
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		$event->order_by('event_from');
		
		$data['rows'] = $event->get($limit, $offset);
		
		$data['page'] = $this->uri->segment(3);
		
		$data['main_content'] = 'event';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function event_save( $id = '', $page = '' )
	{
		$data['page_name'] = '<b>Save Training Event</b>';
		
		$data['msg'] = '';
		
		$this->load->helper('list_box');
		
		$event = new Training_event();
		
		$data['event'] = $event->get_by_id( $id );
		
		if($this->input->post('op'))
		{
			$event->course_id 			= $this->input->post('course_id');
			$event->event_from 			= $this->input->post('event_from');
			$event->event_to 			= $this->input->post('event_from');
			$event->event_venue 		= $this->input->post('event_venue');
			$event->contact_id 			= $this->input->post('contact_id');
			//$event->funder_id 			= $this->input->post('funder_id');
			$event->event_local_cost 	= $this->input->post('event_local_cost');
			$event->event_other_cost 	= $this->input->post('event_other_cost');
			$event->event_duration 		= $this->input->post('event_duration');
			$event->event_eval 			= $this->input->post('event_eval');
			$event->remarks 			= $this->input->post('remarks');
			
			$event->save();
			
			$this->session->set_flashdata('msg', 'Training Event saved!');
			
			redirect(base_url().'training_manage/event/'.$page, 'refresh');
		}
		
		$data['selected'] 				= $event->course_id;
		
		$data['contact_id_selected'] 	= $event->contact_id;
		
		$data['main_content'] = 'event_save';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function event_delete( $id = '', $page = '' )
	{
		$event = new Training_event();
		
		$event->get_by_id( $id );
		
		$event->delete();
		
		$this->session->set_flashdata('msg', 'Training Event Deleted!');
		
		redirect(base_url().'training_manage/event/'.$page, 'refresh');
		
	}
	
	// --------------------------------------------------------------------
	
	function attendance()
	{
		$data['page_name'] = '<b>Training Attendance</b>';
		
		$data['msg'] = '';
		
		$this->load->library('pagination');
		
		$attend = new Training_attendee();
		
		$config['base_url'] = base_url().'training_manage/attendance';
		$config['total_rows'] = $attend->get()->count();
		$config['per_page'] = '15';
		$config['full_tag_open'] = '<p>';
	    $config['full_tag_close'] = '</p>';
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		$attend->order_by('id');
		
		$data['rows'] = $attend->get($limit, $offset);
		
		$data['page'] = $this->uri->segment(3);
		
		$data['main_content'] = 'attendance';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function attendance_save( $id = '', $page = '' )
	{
		$data['page_name'] = '<b>Save Training Attendance</b>';
		
		$data['msg'] = '';
		
		$this->load->helper('list_box');
		
		$event = new Training_event();
		
		$data['event'] = $event->get_by_id( $id );
		
		if($this->input->post('op'))
		{
			$event->course_id 			= $this->input->post('course_id');
			$event->event_from 			= $this->input->post('event_from');
			$event->event_to 			= $this->input->post('event_from');
			$event->event_venue 		= $this->input->post('event_venue');
			$event->contact_id 			= $this->input->post('contact_id');
			//$event->funder_id 			= $this->input->post('funder_id');
			$event->event_local_cost 	= $this->input->post('event_local_cost');
			$event->event_other_cost 	= $this->input->post('event_other_cost');
			$event->event_duration 		= $this->input->post('event_duration');
			$event->event_eval 			= $this->input->post('event_eval');
			$event->remarks 			= $this->input->post('remarks');
			
			$event->save();
			
			$this->session->set_flashdata('msg', 'Training Attendance saved!');
			
			redirect(base_url().'training_manage/attendance/'.$page, 'refresh');
		}
		
		$data['selected'] 				= $event->course_id;
		
		$data['contact_id_selected'] 	= $event->contact_id;
		
		$data['main_content'] = 'attendance_save';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function attendance_delete( $id = '', $page = '' )
	{
		$event = new Training_event();
		
		$event->get_by_id( $id );
		
		$event->delete();
		
		$this->session->set_flashdata('msg', 'Training Attendance Deleted!');
		
		redirect(base_url().'training_manage/attendance/'.$page, 'refresh');
		
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
		$config['full_tag_open'] = '<p>';
	    $config['full_tag_close'] = '</p>';
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		$type->order_by('training_type');
		
		$data['rows'] = $type->get($limit, $offset);
		
		$data['page'] = $this->uri->segment(3);
		
		$data['main_content'] = 'type';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function type_save( $id = '', $page = '' )
	{
		$data['page_name'] = '<b>Save Training Type</b>';
		
		$data['msg'] = '';
		
		$this->load->helper('list_box');
		
		$type = new Training_type();
		
		$data['type'] = $type->get_by_id( $id );
		
		if($this->input->post('op'))
		{
			$type->training_type 		= $this->input->post('training_type');
			$type->training_type_desc 	= $this->input->post('training_type_desc');
			
			$type->save();
			
			$this->session->set_flashdata('msg', 'Training Type saved!');
			
			redirect(base_url().'training_manage/type/'.$page, 'refresh');
		}
		
		$data['main_content'] = 'type_save';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function type_delete( $id = '', $page = '' )
	{
		$type = new Training_type();
		
		$type->get_by_id( $id );
		
		$type->delete();
		
		$this->session->set_flashdata('msg', 'Training Type Deleted!');
		
		redirect(base_url().'training_manage/type/'.$page, 'refresh');
		
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
		$config['full_tag_open'] = '<p>';
	    $config['full_tag_close'] = '</p>';
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		$contact->order_by('contact_name');
		
		$data['rows'] = $contact->get($limit, $offset);
		
		$data['page'] = $this->uri->segment(3);
		
		$data['main_content'] = 'contact_info';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function contact_info_save( $id = '', $page = '' )
	{
		$data['page_name'] = '<b>Save Training Contact Information</b>';
		
		$data['msg'] = '';
		
		$this->load->helper('list_box');
		
		$contact = new Training_contact();
		
		$data['contact'] = $contact->get_by_id( $id );
		
		if($this->input->post('op'))
		{
			$contact->contact_name 		= $this->input->post('contact_name');
			$contact->contact_co 		= $this->input->post('contact_co');
			$contact->contact_address 	= $this->input->post('contact_address');
			$contact->contact_city 		= $this->input->post('contact_city');
			$contact->contact_phone 	= $this->input->post('contact_phone');
			$contact->contact_fax 		= $this->input->post('contact_fax');
			$contact->contact_email 	= $this->input->post('contact_email');
			$contact->contact_specialty = $this->input->post('contact_specialty');
			$contact->contact_type_id 	= $this->input->post('contact_type_id');
			
			$contact->save();
			
			$this->session->set_flashdata('msg', 'Training Contact Information saved!');
			
			redirect(base_url().'training_manage/contact_info/'.$page, 'refresh');
		}
		
		$data['selected'] 	= $contact->contact_type_id;
		
		$data['main_content'] = 'contact_info_save';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function contact_info_delete( $id = '', $page = '' )
	{
		$contact = new Training_contact();
		
		$contact->get_by_id( $id );
		
		$contact->delete();
		
		$this->session->set_flashdata('msg', 'Training Contact Information Deleted!');
		
		redirect(base_url().'training_manage/contact_info/'.$page, 'refresh');
		
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
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function contact_type_save( $id = '', $page = '' )
	{
		$data['page_name'] = '<b>Save Training Contact Type</b>';
		
		$data['msg'] = '';
		
		$this->load->helper('list_box');
		
		$contact = new Training_contact_type();
		
		$data['contact'] = $contact->get_by_id( $id );
		
		if($this->input->post('op'))
		{
			$contact->contact_type		= $this->input->post('contact_type');
			$contact->contact_type_desc = $this->input->post('contact_type_desc');
			
			$contact->save();
			
			$this->session->set_flashdata('msg', 'Training Contact Type saved!');
			
			redirect(base_url().'training_manage/contact_type/'.$page, 'refresh');
		}
		
		$data['main_content'] = 'contact_type_save';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function contact_type_delete( $id = '', $page = '' )
	{
		$contact = new Training_contact_type();
		
		$contact->get_by_id( $id );
		
		$contact->delete();
		
		$this->session->set_flashdata('msg', 'Training Contact Type Deleted!');
		
		redirect(base_url().'training_manage/contact_type/'.$page, 'refresh');
		
	}
	
	// --------------------------------------------------------------------
	
	
}	

/* End of file office_manage.php */
/* Location: ./system/application/modules/office_manage/controllers/office_manage.php */