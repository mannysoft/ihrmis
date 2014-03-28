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
 * @copyright	Copyright (c) 2008 - 2014, Charliesoft
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
		
		
		if ( Input::get('employee_id'))
		{
			$employee_id = Input::get('employee_id');
			redirect('pds/personal_info/'.$employee_id);
		}
		
		$e = new Employee_m();
		
		$data['employee'] 			= $e->get_by_id($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] 		= 'employee_profile';
		
		return View::make('includes/template', $data);
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
		
		if ( Input::get('op'))
		{
			$p = new Personal();
			
			$p->get_by_employee_id($employee_id);
			
			$p->employee_id			= $employee_id;
			$p->lname				= Input::get('lname');
			$p->fname				= Input::get('fname');
			$p->mname 				= Input::get('mname');
			$p->extension 			= Input::get('extension');
			$p->birth_date			= Input::get('birth_date');
			$p->birth_place			= Input::get('birth_place');
			$p->sex					= Input::get('sex');
			$p->civil_status		= Input::get('civil_status');
			$p->citizenship			= Input::get('citizenship');
			$p->height				= Input::get('height');
			$p->weight				= Input::get('weight');
			$p->blood_type			= Input::get('blood_type');
			$p->gsis				= Input::get('gsis');
			$p->pagibig				= Input::get('pagibig');
			$p->philhealth			= Input::get('philhealth');
			$p->sss					= Input::get('sss');
			$p->res_address			= Input::get('res_address');
			$p->res_zip				= Input::get('res_zip');
			$p->res_tel				= Input::get('res_tel');
			$p->permanent_address 	= Input::get('permanent_address');
			$p->permanent_zip		= Input::get('permanent_zip');
			$p->permanent_tel		= Input::get('permanent_tel');
			$p->email				= Input::get('email');
			$p->cp					= Input::get('cp');
			$p->agency_employee_no	= Input::get('agency_employee_no');
			$p->tin					= Input::get('tin');
						
			$p->save();
			
			$e2 = new Employee_m();
			
			$e2->where('id', $employee_id);
						
			$info = array(
						'birth_date' 	=> Input::get('birth_date'),
						'sex' 			=> Input::get('sex'),
						'res_address' 	=> Input::get('res_address')
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
		
		// Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] = 'personal_info';
		
		return View::make('includes/template', $data);
		
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
		
		if ( Input::get('op'))
		{
			$family->get_by_employee_id($employee_id);
			
			$family->employee_id			= $employee_id;
			
			$family->spouse_lname			= Input::get('spouse_lname');
			$family->spouse_fname			= Input::get('spouse_fname');
			$family->spouse_mname 			= Input::get('spouse_mname');
			$family->spouse_occupation 		= Input::get('spouse_occupation');
			$family->spouse_employer		= Input::get('spouse_employer');
			$family->spouse_biz_ad			= Input::get('spouse_biz_ad');
			$family->spouse_tel				= Input::get('spouse_tel');
			$family->father_lname			= Input::get('father_lname');
			$family->father_fname			= Input::get('father_fname');
			$family->father_mname			= Input::get('father_mname');
			$family->mother_lname			= Input::get('mother_lname');
			$family->mother_fname			= Input::get('mother_fname');
			$family->mother_mname			= Input::get('mother_mname');
			
			$family->save();
			
			
			// Children
			$c = new Children();
			
			$c->get_by_employee_id($employee_id);
			
			$c->delete_all();
			
			$children 			= Input::get('children');
			$children_birth_day	= Input::get('children_birth_day');
						
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
		
		return View::make('includes/template', $data);
		
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
		
		if ( Input::get('op'))
		{
			
			
			// EDUCATIONAL BACKGROUND============================================
			
			// ELEMENTARY
			if (Input::get('elem_school') != "")
			{
				
				$e = new Education();
				
				$e->where( 'level',  1);
				$e->where( 'employee_id',  $employee_id )->get();
				$e->delete_all();
				
				$e->employee_id 	= $employee_id;
				$e->level			= 1;
				$e->school_name		= Input::get('elem_school');
				$e->degree_course 	= Input::get('elem_degree');
				$e->year_graduated	= Input::get('elem_grad');
				$e->highest_grade	= Input::get('elem_units');
				$e->attend_from 	= Input::get('elem_date1');
				$e->attend_to		= Input::get('elem_date2');
				$e->scholarship		= Input::get('elem_scho');
				
				$e->save();
			}
			
			// HIGHSCHOOL
			if (Input::get('sec_school') != "")
			{
				$e = new Education();
				
				$e->where( 'level',  2);
				$e->where( 'employee_id',  $employee_id )->get();
				$e->delete_all();
						
				$e->employee_id 	= $employee_id;
				$e->level			= 2;
				$e->school_name		= Input::get('sec_school');
				$e->degree_course 	= Input::get('sec_degree');
				$e->year_graduated	= Input::get('sec_grad');
				$e->highest_grade	= Input::get('sec_units');
				$e->attend_from 	= Input::get('sec_date1');
				$e->attend_to		= Input::get('sec_date2');
				$e->scholarship		= Input::get('sec_scho');
				
				$e->save();
			}
			
			// VOC
			if (Input::get('voc_school') != "")
			{
				
				$e = new Education();
				
				$e->where( 'level',  3);
				$e->where( 'employee_id',  $employee_id )->get();
				$e->delete_all();
						
				$e->employee_id 	= $employee_id;
				$e->level			= 3;
				$e->school_name		= Input::get('voc_school');
				$e->degree_course 	= Input::get('voc_degree');
				$e->year_graduated	= Input::get('voc_grad');
				$e->highest_grade	= Input::get('voc_units');
				$e->attend_from 	= Input::get('voc_date1');
				$e->attend_to		= Input::get('voc_date2');
				$e->scholarship		= Input::get('voc_scho');
				
				$e->save();
			}
			
			// COLLEGE
			if (Input::get('col_school') != "")
			{
				$e = new Education();
				
				$e->where( 'level',  4);
				$e->where( 'employee_id',  $employee_id )->get();
				$e->delete_all();
						
				$e->employee_id 	= $employee_id;
				$e->level			= 4;
				$e->school_name		= Input::get('col_school');
				$e->degree_course 	= Input::get('col_degree');
				$e->year_graduated	= Input::get('col_grad');
				$e->highest_grade	= Input::get('col_units');
				$e->attend_from 	= Input::get('col_date1');
				$e->attend_to		= Input::get('col_date2');
				$e->scholarship		= Input::get('col_scho');
				
				$e->save();
			}
			
			// GRAD SCHOOL
			if (Input::get('grad_school') != "")
			{
				$e = new Education();
				
				$e->where( 'level',  5);
				$e->where( 'employee_id',  $employee_id )->get();
				$e->delete_all();
						
				$e->employee_id 	= $employee_id;
				$e->level			= 5;
				$e->school_name		= Input::get('grad_school');
				$e->degree_course 	= Input::get('grad_degree');
				$e->year_graduated	= Input::get('grad_grad');
				$e->highest_grade	= Input::get('grad_units');
				$e->attend_from 	= Input::get('grad_date1');
				$e->attend_to		= Input::get('grad_date2');
				$e->scholarship		= Input::get('grad_scho');
				
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
		
		return View::make('includes/template', $data);
		
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
		
		if ( Input::get('op'))
		{
			
			$eligibility = new Eligibility();
			
			$eligibility->where( 'employee_id',  $employee_id )->get();
			
			$eligibility->delete_all();
				
			// SERVICE ELIGIBILITY=================================
			$types 					= Input::get('type');
			$rating 				= Input::get('rating');
			$date_exam_conferment 	= Input::get('date_exam_conferment');
			$place_exam_conferment 	= Input::get('place_exam_conferment');
			$license_no 			= Input::get('license_no');
			$license_release_date 	= Input::get('license_release_date');
						
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
		
		return View::make('includes/template', $data);
		
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
		
		if ( Input::get('op'))
		{
			
			// WORK EXPERIENCE=================================
			$work_date1 	= Input::get('work_date1');
			$work_date2 	= Input::get('work_date2');
			$work_position 	= Input::get('work_position');
			$work_office 	= Input::get('work_office');
			$work_salary 	= Input::get('work_salary');
			$work_sg 		= Input::get('work_sg');
			$work_status 	= Input::get('work_status');
			$movement 		= Input::get('movement');
			$work_service 	= Input::get('work_service');
			
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
		
		return View::make('includes/template', $data);
		
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
		
		if ( Input::get('op'))
		{
			// VOLUNTARY WORK OR INVOLVEMENT=========================
			$org_name 					= Input::get('org_name');
			$org_inclusive_date_from 	= Input::get('org_inclusive_date_from');
			$org_inclusive_date_to 		= Input::get('org_inclusive_date_to');
			$org_number_of_hours 		= Input::get('org_number_of_hours');
			$org_position 				= Input::get('org_position');
			
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
		
		return View::make('includes/template', $data);
		
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
		
		// Training=========================================================
		$t = new Training();
		
		//STR_TO_DATE(date_from, '%M %Y') DESC
		
		$t->order_by('date_from', 'DESC');
		//$t->order_by('STR_TO_DATE(date_from, "%Y-%m-%d")', 'DESC');
		//$t->order_by("YEAR(date_from)", 'DESC');
		
		//var_dump($t);
		
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
		
		return View::make('includes/template', $data);
		
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
		
		if ( Input::get('op'))
		{
			// OTHER INFORMATION=========================
			$skills 					= Input::get('skill');
			$recognition 				= Input::get('recognition');
			$membership_organization 	= Input::get('membership_organization');
			
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
			$questions 	= Input::get('q');
			$answer 	= Input::get('q');
			$details 	= Input::get('details');
			
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
			$names 	 = Input::get('ref_name');
			$address = Input::get('ref_address');
			$no 	 = Input::get('ref_tel');
			
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
				
				$r->ctc_no	  		= Input::get('ctc_no');
				$r->issue_at	  	= Input::get('issue_at');
				$r->issue_on	  	= Input::get('issue_on');
				
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
		
		return View::make('includes/template', $data);
		
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
		
		if ( Input::get('op'))
		{
			$p = new Profile();
		
			$p->get_by_id($employee_id);
			
			$p->employee_id	 	= $employee_id;
			$p->item_number	 	= Input::get('item_number');
			$p->position	   	= Input::get('position');
			$p->office_id 		= Input::get('office_id');
			$p->salary_grade 	= Input::get('salary_grade');
			$p->step 			= Input::get('step');
			$p->permanent	  	= Input::get('permanent');
			$p->last_promotion 	= Input::get('last_promotion');
			$p->last_increment 	= Input::get('last_increment');
			$p->level			= Input::get('level');
			$p->eligibility 	= Input::get('eligibility');
			$p->first_day_of_service= Input::get('first_day_of_service');
			$p->graduated	  	= Input::get('graduated');
			$p->course  		= Input::get('course');
			$p->units 		 	= Input::get('units');
			$p->post_grad 	 	= Input::get('post_grad');
					
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
		
		return View::make('includes/template', $data);
		
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
		
		if ( Input::get('op'))
		{
			$date_from 			= Input::get('date_from');
			$date_to 			= Input::get('date_to');
			$designation 		= Input::get('designation');
			$status 			= Input::get('status');
			$salary 			= Input::get('salary');
			$office_entity 		= Input::get('office_entity');
			$lwop 				= Input::get('lwop');
			$branch 			= Input::get('branch');
			$remarks 			= Input::get('remarks');
			$separation_date 	= Input::get('separation_date');
			$separation_cause 	= Input::get('separation_cause');
			
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
					$service->branch			= $branch[$i];
					$service->remarks			= $remarks[$i];
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
		//$service->order_by('date_from');
		
		//http://stackoverflow.com/questions/7482594/weird-backticks-behaviour-in-active-record-in-code-igniter-2-0-3
		$service->select('id, employee_id, date_from, date_to, designation, status, salary, office_entity, branch, remarks, lwop, separation_date, separation_cause, STR_TO_DATE(date_from,"%m/%d/%Y") as nice_date', false);
		$service->order_by("nice_date");

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
		
		return View::make('includes/template', $data);
		
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
		
		$data['records_found'] = '';
		
		if ( Input::get('op'))
		{
			$e = new Employee_m();
		
			if ( Input::get('lname') != '')
			{
				$e->where('lname', Input::get('lname'));
			}
			if ( Input::get('fname') != '')
			{
				$e->where('fname', Input::get('fname'));
			}
			if ( Input::get('position') != '')
			{
				$e->like('position', Input::get('position'));
			}
			if ( Input::get('permanent') != 'all')
			{
				$e->where('permanent', Input::get('permanent'));
			}
			if ( Input::get('office_id') != '0')
			{
				$e->where('office_id', Input::get('office_id'));
			}
			if ( Input::get('salary_grade') != '')
			{
				list($salary_grade, $step) = explode("-", Input::get('salary_grade'));
				$e->where('salary_grade', $salary_grade);
				$e->where('step', $step);
			}
			
			// =======================================================
			if ( Input::get('years_service') != '')
			{
				// If blank search for exact year
				if ( Input::get('years_service_above') == '')
				{
					
				}
				
				$the_year = date('Y') - Input::get('years_service');
				$today = date('Y-m-d');
				
				$e->where('YEAR(first_day_of_service)', $the_year);
				$e->where('MONTH(first_day_of_service) >=', date('m'));
				
	
			}
			if ( Input::get('eligibility') != '')
			{
				$e->like('eligibility', Input::get('eligibility'), 'both'); 
			}
			if ( Input::get('course') != '')
			{
				$e->like('course', Input::get('course'), 'both'); 
			}
			if ( Input::get('sex') != '')
			{
				$e->where('sex', Input::get('sex'));
			}
			
			
			if ( Input::get('age') != '')
			{
				$the_year = date('Y') - Input::get('age');
				
				$e->where('YEAR(birth_date)', $the_year);
				$e->where('MONTH(birth_date) >=', date('m'));
			}
			
			if ( Input::get('location') != '')
			{
				$e->like('res_address', Input::get('location'));
			}
			
			$e->order_by('lname');
			
			$data['rows'] = $e->get();
			
			$data['records_found'] = $e->result_count();
						
			// if search and print preview
			if ( Input::get('search_preview'))
			{
				$data['pop_up'] = 1; 
				
				$preview = new Search_result_preview();
		
				$data['report_file'] = $preview->preview( $data['rows'] , Input::get('report_name'));
			}
						
		}
		
		$data['options'] = array(
							'position' 			=> 'Position/ Designation',
							'department' 		=> 'Office/ Department',
							'employment_status' => 'Employment Status'
							
							);
							
		
		
		//Use for office listbox
		$data['options'] 						= $this->options->office_options( $add_select = TRUE );	
		
		$data['selected'] 						= Input::get('office_id');
		
		$data['permanent_options'] 				= $this->options->type_employment( $all = TRUE );
		$data['permanent_selected'] 			= Input::get('permanent');
		
		$data['years_service_above_options'] 	= array('' => '', 'above' => 'above', 'below' => 'below');
		$data['years_service_above_selected'] 	= Input::get('years_service_above');
		
		$data['age_above_options'] 				= array('' => '', 'above' => 'above', 'below' => 'below');
		$data['age_above_selected']				= Input::get('age_above');
		
		$data['main_content'] = 'reports';
		
		return View::make('includes/template', $data);
		
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
		
		$a = Setting::getField( 'republic' );
		$b = Setting::getField( 'lgu_name' );
		$c = Setting::getField( 'lgu_office' );
		$d = Setting::getField( 'lgu_address' ); // this is for heading republic
		
		$lgu_code = Setting::getField('lgu_code'); 
		
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
	$training_prepared 				= Setting::getField( 'training_prepared' );
	$training_prepared_position 	= Setting::getField( 'training_prepared_position' );
	$training_certified 			= Setting::getField( 'training_certified' );
	$training_certified_position 	= Setting::getField( 'training_certified_position' );

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
		
		$a = Setting::getField( 'republic' );
		$b = Setting::getField( 'lgu_name' );
		$c = Setting::getField( 'lgu_office' );
		$d = Setting::getField( 'lgu_address' ); // this is for heading republic
		
		$lgu_code = Setting::getField('lgu_code'); 
		
		$logo = 'dtr/template/logo/logo.jpg';
		
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
		$sr_prepared 			= Setting::getField( 'sr_prepared' );
		$sr_prepared_position 	= Setting::getField( 'sr_prepared_position' );
		$sr_certified 			= Setting::getField( 'sr_certified' );
		$sr_certified_position 	= Setting::getField( 'sr_certified_position' );

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
		
		//$s->order_by('date_from');
		
		$s->select('id, employee_id, date_from, date_to, designation, status, salary, office_entity, branch, remarks, lwop, separation_date, separation_cause, STR_TO_DATE(date_from,"%m/%d/%Y") as nice_date', false);
		$s->order_by("nice_date");
		
		$rows = $s->get_by_employee_id($employee_id);
	
	$i = 1; 
	
	// Number of entries to display per page
	$first_page = Setting::getField( 'service_record_entries_first_page' );
	$second_page = Setting::getField( 'service_record_entries_second_page' );
	$third_page = Setting::getField( 'service_record_entries_3rd_page' );
	$fourth_page = Setting::getField( 'service_record_entries_4th_page' );
	
	//for ($i ==0; $i != 70; $i ++)
	foreach ($rows as $row)
	{
	
		$number_character = strlen( $row->designation.$row->salary.$row->salary.
							$row->office_entity.$row->lwop.$row->separation_date.$row->separation_cause );
		
		$html .='<tr>
				<td align="center">'.$row->date_from.'</td>
				<td align="center">'.$row->date_to.'</td>
				<td align="center">'.$row->designation.'</td>
				<td align="center">'.$row->status.'</td>
				<td align="right">'.$row->salary.'</td>
				<td align="center">'.$row->office_entity.'</td>
				<td align="left">'.$row->lwop.'</td>
				<td align="left">'.$row->separation_date.'</td>
				<td align="left" style="font-size:7">'.$row->separation_cause.'</td>
			  </tr>';
	  	
		// Second page
	  	if ( $i == $first_page)
		{
			$html .='</table>'; // close the table
			$html .='<pagebreak />'.$service;
		}
		
		// If there is third page
		if ( $i == $first_page + $second_page)
		{
			$html .='</table>'; // close the table
			$html .='<pagebreak />'.$service;
		}
		
		// If there is 4th page
		if ( $i == $first_page + $second_page + $third_page)
		{
			$html .='</table>'; // close the table
			$html .='<pagebreak />'.$service;
		}
		// If there is 5th page
		if ( $i == $first_page + $second_page + $third_page + $fourth_page)
		{
			$html .='</table>'; // close the table
			$html .='<pagebreak />'.$service;
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
		$params = array('format' => 'Legal');
		
		$params = array('format' => Setting::getField( 'service_record_paper_size' ));
		
		$this->load->library('mpdf', $params);
		
		//$mpdf=new mPDF('c','Letter'); 

		//$this->mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins
		
		$stylesheet = file_get_contents(base_url().'css/mpdf/mpdfstyletables.css');
		$this->mpdf->WriteHTML($stylesheet,1); // The parameter 1 tells that this is css/style only and no
		
		$this->mpdf->SetHTMLHeader('Page {PAGENO} of {nb}', '',false);
		//$this->mpdf->SetHTMLFooter('{PAGENO}');
		
		
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
		
		echo Input::get('employee_id');
		
		
		
		
	}
	
	
}	

// Include the class
include('pds_preview.php');
include('sr_preview.php');
include('search_result_preview.php');

/* End of file employee_manage.php */
/* Location: ./application/modules/pds/controllers/pds.php */