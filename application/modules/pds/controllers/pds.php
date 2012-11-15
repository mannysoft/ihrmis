<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Integrated Human Resource Management Information System
 *
 * An Application Software use by Government agencies for management
 * of employees Attendance, Leave Administration, Payroll, Personnel
 * Training, Service Records, Performance, Recruitment and more...
 *
 * @package		iHRMIS
 * @author		Manolito Isles
 * @copyright	Copyright (c) 2008 - 2013, Charliesoft
 * @license		http://charliesoft.net/ihrmis/license
 * @link		http://charliesoft.net
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
 * @author		Manolito Isles
 * @link		http://charliesoft.net/hrmis/user_guide/models/conversion_table.html
 */
class Pds extends MX_Controller  {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		//$this->output->enable_profiler(TRUE);
		$this->load->model('options');
    }  
	
	// --------------------------------------------------------------------
	
	function employee_profile( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Personal Data Sheet</b>';
		$data['msg'] 				= '';
		
		
		if ( $this->input->post('employee_id'))
		{
			$employee_id = $this->input->post('employee_id');
			redirect('pds/personal_info/'.$employee_id);
		}
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] 		= 'employee_profile';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function personal_info( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Personal Data Sheet</b>';
		
		$data['section_name'] 		= '<b>Personal Information</b>';
		
		$data['focus_field']		= 'lname';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( $this->input->post('op'))
		{
			$p = new Personal();
			
			$p->get_by_employee_id($employee_id);
			
			$p->employee_id			= $employee_id;
			$p->lname				= $this->input->post('lname');
			$p->fname				= $this->input->post('fname');
			$p->mname 				= $this->input->post('mname');
			$p->extension 			= $this->input->post('extension');
			$p->birth_date			= $this->input->post('birth_date');
			$p->birth_place			= $this->input->post('birth_place');
			$p->sex					= $this->input->post('sex');
			$p->civil_status		= $this->input->post('civil_status');
			$p->citizenship			= $this->input->post('citizenship');
			$p->height				= $this->input->post('height');
			$p->weight				= $this->input->post('weight');
			$p->blood_type			= $this->input->post('blood_type');
			$p->gsis				= $this->input->post('gsis');
			$p->pagibig				= $this->input->post('pagibig');
			$p->philhealth			= $this->input->post('philhealth');
			$p->sss					= $this->input->post('sss');
			$p->res_address			= $this->input->post('res_address');
			$p->res_zip				= $this->input->post('res_zip');
			$p->res_tel				= $this->input->post('res_tel');
			$p->permanent_address 	= $this->input->post('permanent_address');
			$p->permanent_zip		= $this->input->post('permanent_zip');
			$p->permanent_tel		= $this->input->post('permanent_tel');
			$p->email				= $this->input->post('email');
			$p->cp					= $this->input->post('cp');
			$p->agency_employee_no	= $this->input->post('agency_employee_no');
			$p->tin					= $this->input->post('tin');
						
			$p->save();
			
			$e2 = new Employee_m();
			
			$e2->where('id', $employee_id);
						
			$info = array(
						'birth_date' 	=> $this->input->post('birth_date'),
						'sex' 			=> $this->input->post('sex'),
						'res_address' 	=> $this->input->post('res_address')
						);
									
			$e2->update($info);
			
			$data['msg'] = 'Personal Information has been saved!';
			
						
		}
				
		$data['sex_options'] = array('M'  => 'Male','F'  => 'Female');
		
		$data['civil_status_options'] = array(
												'1'  => 'Single',
												'2'  => 'Married',
												'3'  => 'Annulled',
												'4'  => 'Widowed',
												'5'  => 'Separated',
												'6'  => 'Others'
												);	
		
		$personal = new Personal();
		
		$data['personal'] 			= $personal->get_by_employee_id($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'personal_info';
		
		$this->load->view('includes/template', $data);
		
	}	
	
	// --------------------------------------------------------------------
	
	function family( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Personal Data Sheet</b>';
		
		$data['section_name'] 		= '<b>Personal Information</b>';
		
		$data['focus_field']		= 'spouse_lname';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		$family = new Family();
		
		if ( $this->input->post('op'))
		{
			$family->get_by_employee_id($employee_id);
			
			$family->employee_id			= $employee_id;
			
			$family->spouse_lname			= $this->input->post('spouse_lname');
			$family->spouse_fname			= $this->input->post('spouse_fname');
			$family->spouse_mname 			= $this->input->post('spouse_mname');
			$family->spouse_occupation 		= $this->input->post('spouse_occupation');
			$family->spouse_employer		= $this->input->post('spouse_employer');
			$family->spouse_biz_ad			= $this->input->post('spouse_biz_ad');
			$family->spouse_tel				= $this->input->post('spouse_tel');
			$family->father_lname			= $this->input->post('father_lname');
			$family->father_fname			= $this->input->post('father_fname');
			$family->father_mname			= $this->input->post('father_mname');
			$family->mother_lname			= $this->input->post('mother_lname');
			$family->mother_fname			= $this->input->post('mother_fname');
			$family->mother_mname			= $this->input->post('mother_mname');
			
			$family->save();
			
			
			// Children
			$c = new Children();
			
			$c->get_by_employee_id($employee_id);
			
			$c->delete_all();
			
			$children 			= $this->input->post('children');
			$children_birth_day	= $this->input->post('children_birth_day');
						
			$i = 0;
			
			foreach ($children as $child)
			{
				
				if ($child != "")
				{
					$c = new Children();
					
					$c->employee_id = $employee_id;
					$c->children 	= $children[$i];
					$c->birth_date 	= $children_birth_day[$i];
					
					$c->save();
					
				}
				
				$i++;
			}
			
			
			$data['msg'] = 'Family Background has been saved!';
						
		}
		
		$family = new Family();
		
		
		
		$data['family'] = $family->get_by_employee_id($employee_id);
		
		// Children===================================================
		$children = new Children();
		
		$children->order_by('birth_date');
		
		$children = $children->get_by_employee_id($employee_id);
		
		$i = 0;
		
		foreach ($children as $child)
		{
			$data['children']['name'][] 		= $child->children;
			$data['children']['birth_date'][] 	= $child->birth_date;
			
			$i ++;
		}
		
		if ($i <= 14)
		{
			while($i != 14)
			{
				$data['children']['name'][] = '';
				$data['children']['birth_date'][] 	= '';
				$i ++;
			}
		}
		
		$data['selected'] = $e->office_id;
		
		// Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'family';
		
		$this->load->view('includes/template', $data);
		
	}	
	
	// --------------------------------------------------------------------
	
	function education( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Personal Data Sheet</b>';
		
		$data['section_name'] 		= '<b>Personal Information</b>';
		
		$data['focus_field']		= 'elem_school';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		$e = new Education();
		
		if ( $this->input->post('op'))
		{
			
			
			// EDUCATIONAL BACKGROUND============================================
			
			// ELEMENTARY
			if ($this->input->post('elem_school') != "")
			{
				
				$e = new Education();
				
				$e->where( 'level',  1);
				$e->where( 'employee_id',  $employee_id )->get();
				$e->delete_all();
				
				$e->employee_id 	= $employee_id;
				$e->level			= 1;
				$e->school_name		= $this->input->post('elem_school');
				$e->degree_course 	= $this->input->post('elem_degree');
				$e->year_graduated	= $this->input->post('elem_grad');
				$e->highest_grade	= $this->input->post('elem_units');
				$e->attend_from 	= $this->input->post('elem_date1');
				$e->attend_to		= $this->input->post('elem_date2');
				$e->scholarship		= $this->input->post('elem_scho');
				
				$e->save();
			}
			
			// HIGHSCHOOL
			if ($this->input->post('sec_school') != "")
			{
				$e = new Education();
				
				$e->where( 'level',  2);
				$e->where( 'employee_id',  $employee_id )->get();
				$e->delete_all();
						
				$e->employee_id 	= $employee_id;
				$e->level			= 2;
				$e->school_name		= $this->input->post('sec_school');
				$e->degree_course 	= $this->input->post('sec_degree');
				$e->year_graduated	= $this->input->post('sec_grad');
				$e->highest_grade	= $this->input->post('sec_units');
				$e->attend_from 	= $this->input->post('sec_date1');
				$e->attend_to		= $this->input->post('sec_date2');
				$e->scholarship		= $this->input->post('sec_scho');
				
				$e->save();
			}
			
			// VOC
			if ($this->input->post('voc_school') != "")
			{
				
				$e = new Education();
				
				$e->where( 'level',  3);
				$e->where( 'employee_id',  $employee_id )->get();
				$e->delete_all();
						
				$e->employee_id 	= $employee_id;
				$e->level			= 3;
				$e->school_name		= $this->input->post('voc_school');
				$e->degree_course 	= $this->input->post('voc_degree');
				$e->year_graduated	= $this->input->post('voc_grad');
				$e->highest_grade	= $this->input->post('voc_units');
				$e->attend_from 	= $this->input->post('voc_date1');
				$e->attend_to		= $this->input->post('voc_date2');
				$e->scholarship		= $this->input->post('voc_scho');
				
				$e->save();
			}
			
			// COLLEGE
			if ($this->input->post('col_school') != "")
			{
				$e = new Education();
				
				$e->where( 'level',  4);
				$e->where( 'employee_id',  $employee_id )->get();
				$e->delete_all();
						
				$e->employee_id 	= $employee_id;
				$e->level			= 4;
				$e->school_name		= $this->input->post('col_school');
				$e->degree_course 	= $this->input->post('col_degree');
				$e->year_graduated	= $this->input->post('col_grad');
				$e->highest_grade	= $this->input->post('col_units');
				$e->attend_from 	= $this->input->post('col_date1');
				$e->attend_to		= $this->input->post('col_date2');
				$e->scholarship		= $this->input->post('col_scho');
				
				$e->save();
			}
			
			// GRAD SCHOOL
			if ($this->input->post('grad_school') != "")
			{
				$e = new Education();
				
				$e->where( 'level',  5);
				$e->where( 'employee_id',  $employee_id )->get();
				$e->delete_all();
						
				$e->employee_id 	= $employee_id;
				$e->level			= 5;
				$e->school_name		= $this->input->post('grad_school');
				$e->degree_course 	= $this->input->post('grad_degree');
				$e->year_graduated	= $this->input->post('grad_grad');
				$e->highest_grade	= $this->input->post('grad_units');
				$e->attend_from 	= $this->input->post('grad_date1');
				$e->attend_to		= $this->input->post('grad_date2');
				$e->scholarship		= $this->input->post('grad_scho');
				
				$e->save();
			}
			$data['msg'] = 'Educational Background has been saved!';
						
		}
		
		// Educational Background======================================
		$e = new Education();
		
		$data['educs1'] = $e->get_single_educ($employee_id, $level = 1);
		$data['educs2'] = $e->get_single_educ($employee_id, $level = 2);
		$data['educs3'] = $e->get_single_educ($employee_id, $level = 3);
		$data['educs4'] = $e->get_single_educ($employee_id, $level = 4);
		$data['educs5'] = $e->get_single_educ($employee_id, $level = 5);
		
		$e = new Employee_m();
		$e->get_by_id ($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'education';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function examination( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Personal Data Sheet</b>';
		
		$data['section_name'] 		= '<b>Personal Information</b>';
		
		$data['focus_field']		= 'type';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( $this->input->post('op'))
		{
			
			$eligibility = new Eligibility();
			
			$eligibility->where( 'employee_id',  $employee_id )->get();
			
			$eligibility->delete_all();
				
			// SERVICE ELIGIBILITY=================================
			$types 					= $this->input->post('type');
			$rating 				= $this->input->post('rating');
			$date_exam_conferment 	= $this->input->post('date_exam_conferment');
			$place_exam_conferment 	= $this->input->post('place_exam_conferment');
			$license_no 			= $this->input->post('license_no');
			$license_release_date 	= $this->input->post('license_release_date');
						
			$i = 0;
			
			foreach ($types as $type)
			{
				if ($type != "")
				{
					$e = new Eligibility();
					
					$e->employee_id				= $employee_id;
					$e->type 					= $types[$i];
					$e->rating 					= $rating[$i];
					$e->date_exam_conferment 	= $date_exam_conferment[$i];
					$e->place_exam_conferment	= $place_exam_conferment[$i];
					$e->license_no				= $license_no[$i];
					$e->license_release_date	= $license_release_date[$i];
					
					$e->save();	
						
				}
				
				$i++;
			}
			
			$data['msg'] = 'Examinations has been saved!';
						
		}
		
		$e = new Eligibility();
		
		// Service ===========================================================
		$e->order_by('id');
		$services = $e->get_by_employee_id($employee_id);
		
		$i = 0;
		
		foreach ($services as $service)
		{
			$data['services']['type'][] 					= $service->type;
			$data['services']['rating'][] 					= $service->rating;
			$data['services']['date_exam_conferment'][] 	= $service->date_exam_conferment;
			$data['services']['place_exam_conferment'][] 	= $service->place_exam_conferment;
			$data['services']['license_no'][] 				= $service->license_no;
			$data['services']['license_release_date'][] 	= $service->license_release_date;
			
			$i ++;
		}
		
		if ($i <= 7)
		{
			while($i != 7)
			{
				$data['services']['type'][] 					= '';
				$data['services']['rating'][] 					= '';
				$data['services']['date_exam_conferment'][] 	= '';
				$data['services']['place_exam_conferment'][] 	= '';
				$data['services']['license_no'][] 				= '';
				$data['services']['license_release_date'][] 	= '';
				$i ++;
			}
		}
		
		$e = new Employee_m();
		$e->get_by_id ($employee_id);
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'examination';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function work( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Personal Data Sheet</b>';
		
		$data['section_name'] 		= '<b>Personal Information</b>';
		
		$data['focus_field']		= 'work_date1';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( $this->input->post('op'))
		{
			
			// WORK EXPERIENCE=================================
			$work_date1 	= $this->input->post('work_date1');
			$work_date2 	= $this->input->post('work_date2');
			$work_position 	= $this->input->post('work_position');
			$work_office 	= $this->input->post('work_office');
			$work_salary 	= $this->input->post('work_salary');
			$work_sg 		= $this->input->post('work_sg');
			$work_status 	= $this->input->post('work_status');
			$movement 		= $this->input->post('movement');
			$work_service 	= $this->input->post('work_service');
			
			$work = new Work();
			$work->get_by_employee_id($employee_id);
			
			$work->delete_all();
						
			$i = 0;
			
			foreach ($work_date1 as $work_date)
			{
				if ($work_date != "")
				{
					$work = new Work();
				
					$work->employee_id			= $employee_id;
					$work->inclusive_date_from 	= $work_date1[$i];
					$work->inclusive_date_to 	= $work_date2[$i];
					$work->position 			= $work_position[$i];
					$work->company				= $work_office[$i];
					$work->monthly_salary		= $work_salary[$i];
					$work->salary_grade			= $work_sg[$i];
					$work->status				= $work_status[$i];
					$work->movement				= $movement[$i];
					$work->govt_service			= $work_service[$i];
					
					$work->save();
				
				}
				
				$i++;
			}
			
			
			$data['msg'] = 'Work Experience has been saved!';
						
		}
		
		// Work=============================================================
		$work = new Work();
		$work->order_by('inclusive_date_from', 'DESC');
		
		$data['works'] = $work->get_by_employee_id($employee_id);
		
		$data['govt_service_options'] = array(
										  '1'  => 'Yes',
										  '0'  => 'No'
										);
										
		if ($employee_id == '')
		{
			$data['works'] = array();
		}								
		
		$data['selected'] = $e->office_id;
		
		// Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'work';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function voluntary_work( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Personal Data Sheet</b>';
		
		$data['section_name'] 		= '<b>Personal Information</b>';
		
		$data['focus_field']		= 'org_name';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( $this->input->post('op'))
		{
			// VOLUNTARY WORK OR INVOLVEMENT=========================
			$org_name 					= $this->input->post('org_name');
			$org_inclusive_date_from 	= $this->input->post('org_inclusive_date_from');
			$org_inclusive_date_to 		= $this->input->post('org_inclusive_date_to');
			$org_number_of_hours 		= $this->input->post('org_number_of_hours');
			$org_position 				= $this->input->post('org_position');
			
			$org = new Organization();
		
			$org->get_by_employee_id($employee_id);
			
			$org->delete_all();
			
			$i = 0;
			
			foreach ($org_name as $org)
			{
				if ($org != "")
				{
					$organization = new Organization();
					
					$organization->employee_id 			= $employee_id;
					$organization->name					= $org_name[$i];
					$organization->inclusive_date_from 	= $org_inclusive_date_from[$i];
					$organization->inclusive_date_to 	= $org_inclusive_date_to[$i];
					$organization->number_of_hours		= $org_number_of_hours[$i];
					$organization->position				= $org_position[$i];
					
					$organization->save();
				
				}
				
				$i++;
			}
			
			$data['msg'] = 'Voluntary Work has been saved!';
						
		}
		
		// Voluntary work or involvement ======================================
		$org = new Organization();
		
		$org->order_by('inclusive_date_from', 'DESC');
		
		$data['orgs'] = $org->get_by_employee_id($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'voluntary_work';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function trainings( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Personal Data Sheet</b>';
		
		$data['section_name'] 		= '<b>Personal Information</b>';
		
		$data['focus_field']		= 'tra_name';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( $this->input->post('op'))
		{
			// TRAINING PROGRAMS=========================
			$tra_name 		= $this->input->post('tra_name');
			$tra_date_from 	= $this->input->post('tra_date_from');
			$tra_date_to 	= $this->input->post('tra_date_to');
			$tra_hours 		= $this->input->post('tra_hours');
			$tra_conduct 	= $this->input->post('tra_conduct');
			$tra_location 	= $this->input->post('tra_location');
			
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
		
		// Training=========================================================
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
		
		$data['selected'] = $e->office_id;
		
		// Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'trainings';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function other_info( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Personal Data Sheet</b>';
		
		$data['section_name'] 		= '<b>Personal Information</b>';
		
		$data['focus_field']		= 'skill';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( $this->input->post('op'))
		{
			// OTHER INFORMATION=========================
			$skills 					= $this->input->post('skill');
			$recognition 				= $this->input->post('recognition');
			$membership_organization 	= $this->input->post('membership_organization');
			
			$o = new Other_info();
			
			$o->get_by_employee_id($employee_id);
			
			$o->delete_all();
						
			$i = 0;
			
			foreach ($skills as $skill)
			{
				$o = new Other_info();
			
				$o->employee_id	 			= $employee_id;
				$o->special_skills			= $skills[$i];
				$o->recognition				= $recognition[$i];
				$o->membership_organization	= $membership_organization[$i];
				
				$o->save();	
				
				$i++;
			}
			
			// QUESTIONS=======================================
			$questions 	= $this->input->post('q');
			$answer 	= $this->input->post('q');
			$details 	= $this->input->post('details');
			
			$q = new Question();
			
			$q->get_by_employee_id($employee_id);
			
			// Delete Questions
			$q->delete_all();
			
			$i = 0;
			$count = 0;

			foreach ($questions as $question)
			{
				$count +=1;
				
				$q = new Question();
				
				$q->employee_id = $employee_id;
				$q->question_no = $count;
				$q->answer 	  	= $answer[$i];
				$q->details	  	= $details[$i];
						
				$q->save();
				
				$i++;
			}
			
			// REFERENCE
			$names 	 = $this->input->post('ref_name');
			$address = $this->input->post('ref_address');
			$no 	 = $this->input->post('ref_tel');
			
			$r = new Reference();
			$r->get_by_employee_id($employee_id);
			$r->delete_all();
			
			$i = 0;
			
			foreach ($names as $name)
			{
				$r = new Reference();
				
				$r->employee_id 	= $employee_id;
				$r->name 		  	= $names[$i];
				$r->address 	  	= $address[$i];
				$r->tel_no	  		= $no[$i];
				
				$r->ctc_no	  		= $this->input->post('ctc_no');
				$r->issue_at	  	= $this->input->post('issue_at');
				$r->issue_on	  	= $this->input->post('issue_on');
				
				$r->save();
						
				$i++;
			}
			
			$data['msg'] = 'Other Information has been saved!';
						
		}
		
		// Other information============================================
		$o = new Other_info();
		
		$data['infos'] = $o->get_by_employee_id($employee_id);
		
		// Question ====================================================
		$q = new Question();
		
		$data['question_options'] = array( '0'  => 'No', '1'  => 'Yes' );
		
		$data['question1'] = $q->get_question($employee_id, 1);
		$data['question2'] = $q->get_question($employee_id, 2);
		$data['question3'] = $q->get_question($employee_id, 3);
		$data['question4'] = $q->get_question($employee_id, 4);
		$data['question5'] = $q->get_question($employee_id, 5);
		$data['question6'] = $q->get_question($employee_id, 6);
		$data['question7'] = $q->get_question($employee_id, 7);
		$data['question8'] = $q->get_question($employee_id, 8);
		$data['question9'] = $q->get_question($employee_id, 9);
		$data['question10'] = $q->get_question($employee_id, 10);
		
		// References=================================================
		$r = new Reference();
		$data['references'] = $r->get_by_employee_id($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'other_info';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function position_details( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Personal Data Sheet</b>';
		
		$data['section_name'] 		= '<b>Personal Information</b>';
		
		$data['focus_field']		= 'item_number';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( $this->input->post('op'))
		{
			$p = new Profile();
		
			$p->get_by_id($employee_id);
			
			$p->employee_id	 	= $employee_id;
			$p->item_number	 	= $this->input->post('item_number');
			$p->position	   	= $this->input->post('position');
			$p->office_id 		= $this->input->post('office_id');
			$p->salary_grade 	= $this->input->post('salary_grade');
			$p->step 			= $this->input->post('step');
			$p->permanent	  	= $this->input->post('permanent');
			$p->last_promotion 	= $this->input->post('last_promotion');
			$p->level			= $this->input->post('level');
			$p->eligibility 	= $this->input->post('eligibility');
			$p->first_day_of_service= $this->input->post('first_day_of_service');
			$p->graduated	  	= $this->input->post('graduated');
			$p->course  		= $this->input->post('course');
			$p->units 		 	= $this->input->post('units');
			$p->post_grad 	 	= $this->input->post('post_grad');
					
			$p->save();
			
			$data['msg'] = 'Position details has been saved!';
						
		}
		
		// profile========================================================
		$p = new Profile();
		
		$data['profile'] = $p->get_by_id($employee_id);
		
		//echo $this->db->last_query();
		
		
		$data['selected'] = $e->office_id;
		
		$data['permanent_options'] 	= $this->options->type_employment();
		$data['permanent_selected'] = $p->permanent;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'position_details';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function service_record( $employee_id = '' )
	{
		$data['page_name'] 			= '<b>Personal Data Sheet</b>';
		
		$data['section_name'] 		= '<b>Personal Information</b>';
		
		$data['focus_field']		= 'date_from';
		
		$data['msg'] 				= '';
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id ($employee_id);
		
		if ( $this->input->post('op'))
		{
			$date_from 			= $this->input->post('date_from');
			$date_to 			= $this->input->post('date_to');
			$designation 		= $this->input->post('designation');
			$status 			= $this->input->post('status');
			$salary 			= $this->input->post('salary');
			$office_entity 		= $this->input->post('office_entity');
			$lwop 				= $this->input->post('lwop');
			$separation_date 	= $this->input->post('separation_date');
			$separation_cause 	= $this->input->post('separation_cause');
			
			$service = new Service_record();
			
			$service->get_by_employee_id($employee_id);
			
			$service->delete_all();
						
			$i = 0;
			
			foreach ($date_from as $work_date)
			{
				if ($work_date != "")
				{
					$service = new Service_record();
				
					$service->employee_id		= $employee_id;
					$service->date_from 		= $date_from[$i];
					$service->date_to 			= $date_to[$i];
					$service->designation 		= $designation[$i];
					$service->status			= $status[$i];
					$service->salary			= $salary[$i];
					$service->office_entity		= $office_entity[$i];
					$service->lwop				= $lwop[$i];
					$service->separation_date	= $separation_date[$i];
					$service->separation_cause	= $separation_cause[$i];
					
					$service->save();
				
				}
				
				$i++;
			}
			
			
			$data['msg'] = 'Service Record has been saved!';
						
		}
		
		// Service Record====================================================
		$service = new Service_record();
		$service->order_by('date_from');
		
		$data['services'] = $service->get_by_employee_id($employee_id);
		
		if ($employee_id == '')
		{
			// Meaning get the service record that does not exists
			$data['services'] = $service->get_by_employee_id(9999999999999);
		}
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'service_record';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	
	function scanned_docs()
	{
		echo 'Coming Soon...<a href="'.base_url().'home/home_page'.'">Home</a>';	
	}
	
	
	// --------------------------------------------------------------------
	
	function reports()
	{
		$data['page_name'] 	= '<b>Reports</b>';
		
		$data['pop_up'] = '';
		
		$data['rows'] = array();
		
		if ( $this->input->post('op'))
		{
			$e = new Employee_m();
		
			if ( $this->input->post('lname') != '')
			{
				$e->where('lname', $this->input->post('lname'));
			}
			if ( $this->input->post('fname') != '')
			{
				$e->where('fname', $this->input->post('fname'));
			}
			if ( $this->input->post('position') != '')
			{
				$e->like('position', $this->input->post('position'));
			}
			if ( $this->input->post('permanent') != 'all')
			{
				$e->where('permanent', $this->input->post('permanent'));
			}
			if ( $this->input->post('office_id') != '0')
			{
				$e->where('office_id', $this->input->post('office_id'));
			}
			if ( $this->input->post('salary_grade') != '')
			{
				list($salary_grade, $step) = explode("-", $this->input->post('salary_grade'));
				$e->where('salary_grade', $salary_grade);
				$e->where('step', $step);
			}
			
			// =======================================================
			if ( $this->input->post('years_service') != '')
			{
				// If blank search for exact year
				if ( $this->input->post('years_service_above') == '')
				{
					
				}
				
				$the_year = date('Y') - $this->input->post('years_service');
				$today = date('Y-m-d');
				
				$e->where('YEAR(first_day_of_service)', $the_year);
				$e->where('MONTH(first_day_of_service) >=', date('m'));
				
	
			}
			if ( $this->input->post('eligibility') != '')
			{
				$e->like('eligibility', $this->input->post('eligibility'), 'both'); 
			}
			if ( $this->input->post('course') != '')
			{
				$e->like('course', $this->input->post('course'), 'both'); 
			}
			if ( $this->input->post('sex') != '')
			{
				$e->where('sex', $this->input->post('sex'));
			}
			
			
			if ( $this->input->post('age') != '')
			{
				$the_year = date('Y') - $this->input->post('age');
				
				$e->where('YEAR(birth_date)', $the_year);
				$e->where('MONTH(birth_date) >=', date('m'));
			}
			
			if ( $this->input->post('location') != '')
			{
				$e->like('res_address', $this->input->post('location'));
			}
			
			$e->order_by('lname');
			
			$data['rows'] = $e->get();
			
			// if search and print preview
			if ( $this->input->post('search_preview'))
			{
				$data['pop_up'] = 1; 
				
				$preview = new Search_result_preview();
		
				$data['report_file'] = $preview->preview( $data['rows'] , $this->input->post('report_name'));
			}
						
		}
		
		$data['options'] = array(
							'position' 			=> 'Position/ Designation',
							'department' 		=> 'Office/ Department',
							'employment_status' => 'Employment Status'
							
							);
							
		
		
		//Use for office listbox
		$data['options'] 						= $this->options->office_options( $add_select = TRUE );	
		
		$data['selected'] 						= $this->input->post('office_id');
		
		$data['permanent_options'] 				= $this->options->type_employment( $all = TRUE );
		$data['permanent_selected'] 			= $this->input->post('permanent');
		
		$data['years_service_above_options'] 	= array('' => '', 'above' => 'above', 'below' => 'below');
		$data['years_service_above_selected'] 	= $this->input->post('years_service_above');
		
		$data['age_above_options'] 				= array('' => '', 'above' => 'above', 'below' => 'below');
		$data['age_above_selected']				= $this->input->post('age_above');
		
		$data['main_content'] = 'reports';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function pds_print_preview( $employee_id = '' )
	{
		$pds_preview = new Pds_preview();
		
		$pds_preview->pds( $employee_id );
	}
	
	// --------------------------------------------------------------------
	
	function sr_print_preview1( $employee_id = '' )
	{
		$sr_preview = new Sr_preview();
		
		$sr_preview->preview( $employee_id );
	}
	
	// --------------------------------------------------------------------
	
	function training_preview( $employee_id = '' , $report_name = '')
	{
		$employee = new Employee_m();
		
		$employee->get_by_id( $employee_id );
		
		$office = new Office_m();
		
		 $office->get_by_office_id($employee->office_id);
		 
		 $type_employment = $this->options->type_employment();
		
		$a = $this->Settings->get_selected_field( 'republic' );
		$b = $this->Settings->get_selected_field( 'lgu_name' );
		$c = $this->Settings->get_selected_field( 'lgu_office' );
		$d = $this->Settings->get_selected_field( 'lgu_address' ); // this is for heading republic
		
		$lgu_code = $this->Settings->get_selected_field('lgu_code'); 
		
		// Laguna Province
		if ( $lgu_code == 'laguna_province' )
		{
			$logo = 'dtr/template/laguna_province/logo.jpg';			
		}
		
		$html = '
		

		
		<table width="100%" border="0" cellpadding="5">
		  <tr>
		  <td colspan="4" align="center" style="font-family:\'Times New Roman\', Times, serif"><b><em>'.$a.'</em></b></td>
		  </tr>
		  <tr>
		  <td colspan="4" align="center" style="font-family:\'Times New Roman\', Times, serif"><b><em>'.$b.'</em></b></td>
		  </tr>
		  <tr>
		  <td colspan="4" align="center" style="font-family:\'Times New Roman\', Times, serif"><b><em>'.$c.'</em></b></td>
		  </tr>
		  <tr>
		  <td colspan="4" align="center" style="font-family:\'Times New Roman\', Times, serif"><b><em>'.$d.'</em></b></td>
		  </tr>
		  <tr>
		  <td colspan="4" align="center" style="font-family:\'Times New Roman\', Times, serif">&nbsp;</td>
		  </tr>
		  <tr>
		  <td colspan="4" align="center" style="font-family:\'Times New Roman\', Times, serif">&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="4" align="center" style="font-size:18px;">Employee Training Record</td>
		  </tr>
		  <tr>
			<td width="16%">&nbsp;</td>
			<td width="35%">&nbsp;</td>
			<td width="27%">&nbsp;</td>
			<td width="22%">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="left"><strong>Name:</strong></td>
			<td>'.$employee->lname.', '.$employee->fname.' '.$employee->mname.'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td align="left"><strong>Department:</strong></td>
			<td>'.$office->office_name.'</td>
			<td align="left"><strong>Sex:</strong></td>
			<td>'.$employee->sex.'</td>
		  </tr>
		  <tr>
			<td align="left"><strong>Position:</strong></td>
			<td>'.$employee->position.'</td>
			<td align="left"><strong>Employment Status:</strong></td>
			<td>'.$type_employment[$employee->permanent].'</td>
		  </tr>
		</table>
		


		
		
		<table width="100%" border="0">
	  <tr>
		<td colspan="3" align="center">'.$report_name.'</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	</table>
			





			
			
	<table width="100%" border="1">
	<tbody><tr>
	  <td width="10%"><strong>Date From</strong></td>
	  <td width="9%"><strong>Date to</strong></td>
	  <td width="4%"><strong>Course Title</strong></td>
	  <td width="10%"><strong>Duration</strong></td>
	  <td width="13%"><strong>Conducted By</strong></td>
	 </tr>';
		
		$params = array('format' => 'Letter');
		
		$this->load->library('mpdf', $params);
		// LOAD a stylesheet
		$stylesheet = file_get_contents(base_url().'css/mpdf/mpdfstyletables.css');
		$this->mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
		$this->mpdf->WriteHTML($html);
		
		// Training===========================================================
		$t = new Training();
		
		$t->order_by('date_from', 'DESC');
		
		$rows = $t->get_by_employee_id($employee_id);
		
		foreach($rows as $row)
		{
			
			
			$entry='
			<tr>
				<td>'.$row->date_from.'</td>
				 <td>'.$row->date_to.'</td>
				 <td>'.$row->name.'</td>
				 <td>'.$row->number_hours.'</td>
				 <td>'.$row->conducted_by.'</td>
			</tr>';
			
			$this->mpdf->WriteHTML($entry);
		}
		
		
		
	$signatories='
	<tr>
	  <td></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	</tbody></table>
	
			

	
	';


	// Signatories
	$training_prepared 				= $this->Settings->get_selected_field( 'training_prepared' );
	$training_prepared_position 	= $this->Settings->get_selected_field( 'training_prepared_position' );
	$training_certified 			= $this->Settings->get_selected_field( 'training_certified' );
	$training_certified_position 	= $this->Settings->get_selected_field( 'training_certified_position' );

	$signatories.='
	<table width="100%" border="0">
	  <tr>
		<td width="38%">&nbsp;</td>
		<td width="23%">&nbsp;</td>
		<td width="39%">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="center">PREPARED BY:</td>
		<td>&nbsp;</td>
		<td align="center">CERTIFIED CORRECT:</td>
	  </tr>
	  <tr>
		<td align="center">&nbsp;</td>
		<td>&nbsp;</td>
		<td align="center">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="center">&nbsp;</td>
		<td>&nbsp;</td>
		<td align="center">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="center">'.$training_prepared.'</td>
		<td>&nbsp;</td>
		<td align="center">'.$training_certified.'</td>
	  </tr>
	  <tr>
		<td align="center">'.$training_prepared_position.'</td>
		<td>&nbsp;</td>
		<td align="center">'.$training_certified_position.'</td>
	  </tr>
	</table>
	';
	
		$this->mpdf->WriteHTML($signatories);
		
		$this->mpdf->Output('dtr/template/pds/archives/pds_'.date('Y_m_d').'.pdf', 'I');
	}
	
	
	function sr_print_preview( $employee_id = '' , $report_name = '')
	{
		
		$a = $this->Settings->get_selected_field( 'republic' );
		$b = $this->Settings->get_selected_field( 'lgu_name' );
		$c = $this->Settings->get_selected_field( 'lgu_office' );
		$d = $this->Settings->get_selected_field( 'lgu_address' ); // this is for heading republic
		
		$lgu_code = $this->Settings->get_selected_field('lgu_code'); 
		
		// Laguna Province
		if ( $lgu_code == 'laguna_province' )
		{
			$logo = 'dtr/template/laguna_province/logo.jpg';			
		}
		
		$employee = new Employee_m();
		
		$employee->get_by_id( $employee_id );

		$personal = new Personal();
		
		$personal->get_by_employee_id( $employee_id );
		
		
		// Signatories
		$sr_prepared 			= $this->Settings->get_selected_field( 'sr_prepared' );
		$sr_prepared_position 	= $this->Settings->get_selected_field( 'sr_prepared_position' );
		$sr_certified 			= $this->Settings->get_selected_field( 'sr_certified' );
		$sr_certified_position 	= $this->Settings->get_selected_field( 'sr_certified_position' );

$service = '<table width="100%" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td colspan="5" align="center" style="font-size:25px"><strong>SERVICE RECORD</strong></td>
  </tr>
  <tr>
    <td width="24%" align="left"><strong>Employee Number :</strong></td>
    <td width="22%"><b>'.$employee->employee_id.'</b></td>
    <td width="15%">&nbsp;</td>
    <td width="29%">&nbsp;</td>
    <td width="10%">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><strong>Name :</strong></td>
    <td colspan="3" style="font-family:\'Times New Roman\', Times, serif"><em><b>'.$employee->lname.',   '.$employee->fname.'    '.$employee->mname.'</b></em></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><strong>Birthday :</strong></td>
    <td><em><b>'.$employee->birth_date.'</b></em></td>
    <td align="right"><strong>Birthplace :</strong></td>
    <td><em><b>'.$personal->birth_place.'</b></em></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" align="left" style="font-size:11px"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>This is to certify that the employee named herein above actually rendered services in this Office as shown by the service record below, each line of which is supported by appointment and other papers actually issued by this Office and approved by the authorities concerned.</em></td>
  </tr>
</table>


<table width="100%" border="1">
  <tr>
    <td colspan="2" align="center" valign="middle">SERVICE<br />
    (Inclusive Date)</td>
    <td colspan="3" align="center" valign="middle">RECORDS OF APPOINTMENT</td>
    <td align="center" valign="middle">OFFICE ENTITY / DIVISION</td>
    <td align="center" valign="middle">L/V ABS<br />
    W/O PAY</td>
    <td colspan="2" align="center" valign="middle">SEPARATION</td>
  </tr>
  <tr>
    <td align="center">From</td>
    <td align="center">To</td>
    <td align="center">Designation</td>
    <td align="center">Status</td>
    <td align="center">Salary</td>
    <td align="center">Station/Place of Assignment/Branch</td>
    <td align="center">&nbsp;</td>
    <td align="center">Date</td>
    <td align="center">Cause</td>
  </tr>



';


$html = '
<!-- defines the headers/footers - this must occur before the headers/footers are set -->

<!--mpdf
<htmlpagefooter name="myfooter">
<table width="100%">
  <tr>
    <td colspan="3" align="center">-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --  </td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Issued in compliance with Executive Order No. 54 Dated August 10, 1954, and in accordance with Circular No. 58, dated August 10, 1954, of the System.</td>
  </tr>
  <tr>
    <td width="19%">&nbsp;</td>
    <td width="42%">&nbsp;</td>
    <td width="39%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center">PREPARED BY</td>
    <td align="center">CERTIFIED CORRECT</td>
  </tr>
  <tr>
    <td align="center">'.date('F d, Y').'</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">Date</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">'.$sr_prepared.'</td>
    <td align="center">'.$sr_certified .'</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center">'.$sr_prepared_position.'</td>
    <td align="center">'.$sr_certified_position.'</td>
  </tr>
</table></htmlpagefooter>

mpdf-->

<!-- set the headers/footers - they will occur from here on in the document -->
<!--mpdf
<sethtmlpagefooter name="myfooter" page="all" value="1"/>
mpdf-->

<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td align="center" style="font-family:\'Times New Roman\', Times, serif"><b><em>'.$a.'</em></b></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center" style="font-family:\'Times New Roman\', Times, serif"><b><em>'.$b.'</em></b></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center" style="font-family:\'Times New Roman\', Times, serif"><b><em>'.$c.'</em></b></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center" style="font-family:\'Times New Roman\', Times, serif"><b><em>'.$d.'</em></b></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<style type="text/css">
#apDiv1 {
	position:absolute;
	width:104px;
	height:106px;
	z-index:1;
	left: 100px;
	top: 55px;
}
</style>
<div id="apDiv1"><img src="'.base_url().$logo.'" alt="" name="logo" width="110" height="110"/></div>

'.$service;
	
		
		$s = new Service_record();
		
		$s->order_by('date_from');
		
		$rows = $s->get_by_employee_id($employee_id);
	
	$i = 0; 
	

	//for ($i ==0; $i != 70; $i ++)
	foreach ($rows as $row)
	{
	
		$number_character = strlen( $row->designation.$row->salary.$row->salary.
							$row->office_entity.$row->lwop.$row->separation_date.$row->separation_cause );
		
		$html .='<tr>
				<td align="center">'.$row->date_from.'</td>
				<td align="center">'.$row->date_to.'</td>
				<td align="left">'.$row->designation.'</td>
				<td align="left">'.$row->status.'</td>
				<td align="right">'.$row->salary.'</td>
				<td align="left">'.$row->office_entity.'</td>
				<td align="left">'.$row->lwop.'</td>
				<td align="left">'.$row->separation_date.'</td>
				<td align="left" style="font-size:7">'.$row->separation_cause.'</td>
			  </tr>';
	  	
		// Second page
	  	if ( $i == 24)
		{
			$html .='</table>'; // close the table
			$html .='<pagebreak />'.$service;
			
			$html .='<tr>
				<td align="center">'.$row->date_from.'</td>
				<td align="center">'.$row->date_to.'</td>
				<td align="left">'.$row->designation.'</td>
				<td align="left">'.$row->status.'</td>
				<td align="right">'.$row->salary.'</td>
				<td align="left">'.$row->office_entity.'</td>
				<td align="left">'.$row->lwop.'</td>
				<td align="left">'.$row->separation_date.'</td>
				<td align="left">'.$row->separation_cause.'</td>
			  </tr>';
			
		}
		
		// If there is third page
		if ( $i == 53)
		{
			$html .='</table>'; // close the table
			$html .='<pagebreak />'.$service;
			
			$html .='<tr>
				<td align="center">'.$row->date_from.'</td>
				<td align="center">'.$row->date_to.'</td>
				<td align="left">'.$row->designation.'</td>
				<td align="left">'.$row->status.'</td>
				<td align="right">'.$row->salary.'</td>
				<td align="left">'.$row->office_entity.'</td>
				<td align="left">'.$row->lwop.'</td>
				<td align="left">'.$row->separation_date.'</td>
				<td align="left">'.$row->separation_cause.'</td>
			  </tr>';
			
		}
	
		$i++;  
	
	}
	
  
  $html .='</table>';

//$html.='
//<pagebreak />
//'.$service.'</table>


//<pagebreak />


//';
		$params = array('format' => 'Letter');
		
		$this->load->library('mpdf', $params);
		
		//$mpdf=new mPDF('c','Letter'); 

		$this->mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins
		
		$stylesheet = file_get_contents(base_url().'css/mpdf/mpdfstyletables.css');
		$this->mpdf->WriteHTML($stylesheet,1); // The parameter 1 tells that this is css/style only and no
		
		
		$this->mpdf->WriteHTML($html);
		
		$this->mpdf->Output();
		
	}
	
	// --------------------------------------------------------------------
	
	function employees($office_id = '')
	{
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		
		$profile 	= new Profile();
		
		$profile->order_by('lname');
			
		$employees 	= $profile->get_by_office_id( $office_id );
		
		$json 		= array();
		
		foreach ($employees as $employee)
		{
			//$personal->get_by_id( $employee->employee_id );
			
			$json[$employee->id] = $employee->lname.', '.$employee->fname;
		}
		
		//$json = sort($json);
		
		echo json_encode($json);
		
		
		
	}
	
	function change_employee($office_id = '')
	{
		
		echo $this->input->post('employee_id');
		
		
		
		
	}
	
	
}	

// Include the class
include('pds_preview.php');
include('sr_preview.php');
include('search_result_preview.php');

/* End of file employee_manage.php */
/* Location: ./application/modules/pds/controllers/pds.php */