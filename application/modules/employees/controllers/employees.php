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
 * iHRMIS Employees Class
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
class Employees extends MX_Controller  {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		//$this->output->enable_profiler(TRUE);
		
		$this->load->model('options');
		
		$this->load->helper('directory');
    }  
	
	// --------------------------------------------------------------------
	
	/**
	 * Enter description here...
	 *
	 */
	function index()
	{

		$data['page_name'] 	= '<b>Employee List</b>';
		$data['msg'] 		= '';
		$data['pop_up'] 	= '';

		
		$off = $this->uri->segment(4, 0);
		
		if ($off == 0)
		{
			$data['selected'] = $office_id = Session::get('office_id');
		}
		else
		{
			$office_id = $off;
			$data['selected'] = $office_id;
		}
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		
		$this->Employee->fields = array( 'id' );
		
		$this->Employee->get_employee_list( $office_id );
		
		$this->load->library('mi_pagination');
		
		$config['base_url'] = base_url().'employees/index';
		$config['total_rows'] = $this->Employee->num_rows;
		$config['office_id'] = $office_id; //add ko
	    $config['per_page'] = '15';
		
		$this->config->load('pagination', TRUE);
		
		$pagination = $this->config->item('pagination');
		
		// We will merge the config file of pagination
		$config = array_merge($config, $pagination);
		
		$employee_id = '';
		
		//http://localhost/hris/user_guide/libraries/uri.html
		
		$this->mi_pagination->initialize($config);
		
		// Added Oct 25 2013
		$this->Employee->detailed_office_id = $office_id;
		
		$this->Employee->fields = array(
									'id',
									'employee_id',
									'fname',
									'mname',
									'lname',
									'office_id',
									'status',
									'pics',
									'position'
									);
		
		$data['query_result'] = $this->Employee->get_employee_list($office_id, 
																   $employee_id, 
																   $config['per_page'], 
																   $this->uri->segment(3)
																   );

		
		//if form submit
		if(Input::get('op') == 1)
		{
			$employees = Input::get('employee');
			
			if(is_array($employees))
			{
				foreach($employees as $employee)
				{
					$action = Input::get('action');
					//deactivate
					if($action==0)
					{
						$this->Employee->set_status($employee, 0);					
					}
					
					//if activate
					if($action==1)
					{
						$this->Employee->set_status($employee, 1);
					}
					
				}
				
			}
			
			$office_id 		= Input::get('office_id');
			$employee_id 	= Input::get('employee_id');
			$lname 			= Input::get('lname');
			
			$this->Employee->get_employee_list($office_id, $employee_id);
			
			$config['base_url'] = base_url().'employees/index/';
			$config['total_rows'] = $this->Employee->num_rows;
			$config['office_id'] = $office_id; //add ko
			$config['per_page'] = '15';
			
			
			$data['query_result'] = $this->Employee->get_employee_list($office_id, 
																	   $employee_id, 
																	   $config['per_page'], 
																	   $this->uri->segment(3)
																	   );
			
			// If search
			if ($lname != '')
			{
				$this->Employee->get_employee_list('',
												   '',
												   $config['per_page'],
												   $this->uri->segment(3),
												   $lname
												   );
				
				$config['total_rows'] = $this->Employee->num_rows;
				
				$data['query_result'] = $this->Employee->get_employee_list('',
																		   '',
																		   $config['per_page'],
																		   $this->uri->segment(3),
																		   $lname
																		   );
			}
			
			
			// If search
			if ($employee_id != '')
			{
				$this->Employee->get_employee_list('',
												   $employee_id,
												   $config['per_page'],
												   $this->uri->segment(3)
												   );
				
				$config['total_rows'] = $this->Employee->num_rows;
				
				$data['query_result'] = $this->Employee->get_employee_list('',
																		   $employee_id,
																		   $config['per_page'],
																		   $this->uri->segment(3)
																		   );
			}
			
			
			
			$data['selected'] = Input::get('office_id');
		
		}
	
			
		//START -- maker buttons -- ADDED BY : MICHAEL RAFALLO ---			
		if(Input::get('cancel')) // cancel all the selected items from the ID maker
		{
			$ie = new Employee_id_request_m();
			$ie->truncate();
			return Redirect::to('employees/index');
		}
		
		//cancel button
		$data['btn_cart'] ='';
		
		
		$ie = new Employee_id_request_m();
		
		$count_request = $ie->get()->count();;
		if($count_request >= 1) //count id from the session
		{
			//use for messaging
			$data['cart'] = 'You have <b><a href="'.base_url().'employees/id_request">'
						     .$count_request.'</b> pending request for ID!</a>';	
			//generate and clear button							
			$data['btn_cart'] = '<input name="generate_id" type="submit" value=" Generate ID " class="button"/> 
								  <input type="submit" name="cancel" value=" Clear " class="button">';
		}
		else
		{
			$data['cart'] = ' You have no pending request for ID!';
			$count_request = 0;
		}
		//END --- ID maker buttons -- ADDED BY : MICHAEL RAFALLO ---
	
		//START -- print preview -- ADDED BY : MICHAEL RAFALLO -------
		if (Input::get('generate_id'))
		{	
			$ie = new Employee_id_request_m();
			$id_cart = $ie->get();
			
			$data['pop_up'] = 1; 
						
			$preview = new Id_preview();
			
			$preview->back_id($id_cart);					
			$preview->front_id($id_cart);
			
			$data['report_file'] = $preview->generated_id_preview($id_cart);
		}
		
		//END ----- print preview	-- ADDED BY : MICHAEL RAFALLO --- 
		
		$data['page']  = $this->uri->segment(3, 0);
		
		$this->mi_pagination->initialize($config);
				
		$data['main_content'] = 'index';
		
		return View::make('includes/template', $data);
	}
	// -------------------------------------------------------------------------------------
	
	/**
	 * ADD TO CART...
	 * ADDED BY : MICHAEL RAFALLO
	 * SINCE VERSION 2.0
	 */
	function add_cart($page, $id ='', $office_id ='')  
	{
		$e = new Employee_id_request_m();
		
		if($id != '')
		{
			$e->get_by_employee_id($id);
		}
		
		$e->employee_id = $id;
		$e->status = 'requested';
		$e->date_request = date('Y-m-d');
		
		$e->save();
		
		//return Redirect::to('employees/index/'.$page.'/'.$office_id);
		return Redirect::to('employees/index/'.$page.'/'.$office_id);
	}
	//---------------------------------------------------------------------------------
	
	/**
	 * REMOVE TO CART...
	 * ADDED BY : MICHAEL RAFALLO
	 * SINCE VERSION 2.0
	 */
	function remove_cart($page, $id, $url ='', $office_id ='')  
	{
		$e = new Employee_id_request_m();
		$e->get_by_employee_id( $id );
		$e->delete();

		if($url == 1)
		{
			return Redirect::to('employees/id_request/');
		}
		else
		{
			return Redirect::to('employees/index/'.$page.'/'.$office_id);
		}
	}
	// --------------------------------------------------------------------
	
	/**
	 * PAGE FOR ID REQUEST ...
	 * ADDED BY : MICHAEL RAFALLO
	 * SINCE VERSION 2.0
	 */
	function id_request()
	{
		$data['page_name'] 			= '<b>ID Request List</b>';
		$data['msg'] 				= '';
		$data['pop_up'] = '';
		
		$off = $this->uri->segment(4, 0);
						
		//echo $off;
		if ($off == 0)
		{
			$office_id = Session::get('office_id');
			$data['selected'] = Session::get('office_id');
		}
		else
		{
			$office_id = $off;
			$data['selected'] = $office_id;
		}
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
	
		$e = new Employee_id_request_m();
		
		$off = $this->uri->segment(4, 0);
		
		$this->load->library('mi_pagination');
		
		$config['base_url'] 	  = base_url().'employees/id_request';
		$config['total_rows'] 	  = $e->count();
		$config['office_id']  	  = $office_id; //add ko
	    $config['per_page']   	  = '15';
	    $config['full_tag_open']  = '<p>';
	    $config['full_tag_close'] = '</p>';
		$config['next_link'] 	  = 'Next';
		$config['prev_link'] 	  = 'Previous';
		
		$data['results'] = $e->get($config['per_page'],$this->uri->segment(3));
		
		$this->mi_pagination->initialize($config);
		
		//START -- generate maker buttons -- ADDED BY : MICHAEL RAFALLO ---			
		if(Input::get('cancel')) // cancel all the selected items from the ID maker
		{
			$ie = new Employee_id_request_m();
			$ie->truncate();
			return Redirect::to('employees/id_request');
		}
		
		//cancel button
		$data['btn_cart'] ='';
		
		$ie = new Employee_id_request_m();
		
		$count_request = $ie->get()->count();;
		if($count_request >= 1) //count id from the session
		{
			$data['cart'] = 'You have <b>'.$count_request.'</b> pending request for ID!';	
										
			$data['btn_cart'] = '<input name="generate_id" type="submit" value=" Generate ID " class="button"/> 
								  <input type="submit" name="cancel" value=" Clear " class="button">';
		}
		else
		{
			$data['cart'] = ' You have no pending request for ID!';
			$count_request = 0;
		}
		//END --- ID maker buttons -- ADDED BY : MICHAEL RAFALLO ---
	
		//START -- print preview -- ADDED BY : MICHAEL RAFALLO -------
		if (Input::get('generate_id'))
		{	
			$ie = new Employee_id_request_m();
			$id_cart = $ie->get();
			
			$data['pop_up'] = 1; 
						
			$preview = new Id_preview();
			
			$preview->back_id($id_cart);					
			$preview->front_id($id_cart);
			
			$data['report_file'] = $preview->generated_id_preview($id_cart);
		}
		//END ----- print preview	-- ADDED BY : MICHAEL RAFALLO --- 	
		
		$data['page']  = $this->uri->segment(3, 0);
		$data['count'] = $config['total_rows'];
		$data['main_content'] = 'id_request';
		
		return View::make('includes/template', $data);
	}
	// --------------------------------------------------------------------
	
	/**
	 * Enter description here...
	 *
	 */
	function add_employee()
	{
		$data['page_name'] 			= '<b>Add employee</b>';
		$data['msg'] 				= '';
				
		//Office
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= Session::get('office_id');
		
		// Divisions options		
		$data['division_options'] 	= $this->options->division_options(Session::get('office_id'));
		
		//Detailed office
		$detailed_options 			= $this->options->office_options($add_select = TRUE);
		$data['detailed_options'] 	= $detailed_options;
		$data['detailed_selected'] 	= '';
		
		//Type of employment
		$data['permanent_options'] 	= $this->options->type_employment();
		$data['permanent_selected'] = '';
		
		//Salary grade options
		$data['sg_options']  		= $this->options->salary_grade();
		$data['sg_selected'] 		= '';
		
		//Step increment
		$data['step_options'] 		= $this->options->step();
		$data['step_selected'] 		= '';
		
		//Shift List
		$data['shifts_options'] 	= $this->options->shift();
		
		// Lets check if the auto generate employee
		// number is enabled
		
		$data['employee_id_readonly'] = '';
		$data['auto_generate_employee_id'] = 'no';
		
		$auto_generate_employee_id = Setting::getField( 'auto_generate_employee_id' );
		
		$data['auto_employee_id'] = '';
		
		if ($auto_generate_employee_id == 'yes')
		{
			$data['employee_id_readonly'] = 'readonly';
			$data['auto_generate_employee_id'] = 'yes';
			
			// Lets get the maximum employee_id
			$e = new Employee_m();
			$e->where('office_id', Session::get('office_id'));
			$e->select_max('employee_id');
			$e->get();
			
			//$data['auto_employee_id'] = $e->employee_id + 1;
			
			//echo $this->db->last_query();
			
		}
				
		//If form submit
		if(Input::get('op'))
		{
			
			$this->form_validation->set_rules('employee_id', 'Employee ID', 'required|callback_employee_id_check');
			$this->form_validation->set_rules('salutation', 'Salutation', 'required');
			$this->form_validation->set_rules('lname', 'Last Name', 'required');
			$this->form_validation->set_rules('fname', 'First Name', 'required');
			$this->form_validation->set_rules('extension', 'First Name', '');
			$this->form_validation->set_rules('position', 'Position', 'required');
			$this->form_validation->set_rules('permanent', 'Type of employment', 'required');
			//$this->form_validation->set_rules('password', 'Password', 'required|matches[repassword]');
			
			if ($this->form_validation->run($this) == FALSE)
			{
				$data['selected'] 			= Input::get('office_id');
				$data['detailed_selected'] 	= Input::get('detailed_office_id');
				$data['permanent_selected'] = Input::get('permanent');
				$data['sg_selected'] 		= Input::get('sg');
				$data['step_selected'] 		= Input::get('step');
			}
			else
			{
			
				$shift_id 				= Input::get('shift2');
				$shift_type 			= Input::get('shift2');
	
				//File name of the photo
				$file_register = Session::get('file_register');
				$finger_pics = '/../'.current_work_dir().'/pics/'.Session::get('file_register');
				
				$info = array(
				'employee_id' 			=> Input::get('employee_id'),
				'lname' 				=> Input::get('lname'),
				'fname' 				=> Input::get('fname'),
				'mname' 				=> Input::get('mname'),
				'extension' 			=> Input::get('extension'),
				'position' 				=> Input::get('position'),
				'assistant_dept_head' 	=> Input::get('assistant_dept_head'),
				'office_id' 			=> Input::get('office_id'),
				'division_id' 			=> Input::get('division_id'),
				'section_id' 			=> Input::get('section_id'),
				'detailed_office_id'	=> Input::get('detailed_office_id'),
				'salut'					=> Input::get('salutation'),
				'pics' 					=> $file_register,
				'finger_pics' 			=> $finger_pics,
				'shift_id' 				=> $shift_id,
				'shift_type' 			=> $shift_type,
				'status' 				=> 1,
				'permanent' 			=> Input::get('permanent'),
				'first_day_of_service' 	=> Input::get('first_day_of_service'),
				'salary_grade' 			=> Input::get('sg'),
				'step'					=> Input::get('step'),
				'newly_added' 			=> 1,
				'updated'				=> 1,
				'emergency_contact'		=> Input::get('emergency_contact'),
				'emergency_contact_no'	=> Input::get('emergency_contact_no'),
				);
		
				$id = $this->Employee->add_employee($info);
				
				$this->Logs->insert_logs('employees', 
										'ADD EMPLOYEE', 
										'Add new employee ('.$id.')', 
										$id);
										
				// Use for messaging
				Session::flash('msg', 'New Employee added!');
				
				if ($this->config->item('active_apps') == 'hris')
				{
					// Add to personal info
					$p = new Personal_m();
					
					$p->get_by_employee_id( $id );
					
					$p->employee_id		= $id;
					$p->lname			= Input::get('lname');
					$p->fname			= Input::get('fname');
					$p->mname			= Input::get('mname');
					
					$p->save(); 
					
					
					// Redirect to pds page
					//return Redirect::to('pds/employee_profile/'.$id, 'refresh');		
				}
				
				// Redirect to adding new employee form
				return Redirect::to('employees/add_employee', 'refresh');				
			}
					
		}
		
		$data['main_content'] = 'add_employee';
		
		return View::make('includes/template', $data);
		
	}	

	// --------------------------------------------------------------------
	
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $employee_id
	 * @param unknown_type $office_id
	 * @param unknown_type $page
	 */
	function edit_employee($employee_id = '', $office_id = '', $page = '')
	{
		$data['page_name'] = '<b>Edit Employee</b>';
		$data['msg'] = '';
		
		$this->Employee->fields = array(
										'shift_id',
										'friday_exempted',
										'office_id',
										'detailed_office_id',
										'permanent',
										'first_day_of_service',
										'position',
										'assistant_dept_head',
										'employee_id',
										'division_id',
										'salary_grade',
										'step',
										'pics',
										'id',
										'salut',
										'lname',
										'fname',
										'mname',
										'extension',
										'orig_id',
										'emergency_contact',
										'emergency_contact_no'
										);
		
		$employee_info = $this->Employee->get_employee_info($employee_id);
		
		if ($employee_id == '')
		{
			$employee_info = $this->Employee->get_employee_info(Input::get('orig_id'));
		}
		
		$shift_id_from_select = $employee_info['shift_id'];
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		$data['selected'] = $employee_info['office_id'];
		$data['division_id'] = $employee_info['division_id'];
		
		//for detailed office
		$data['detailed_options'] = $this->options->office_options($add_select = TRUE);
		$data['detailed_selected'] = $employee_info['detailed_office_id'];
		
		//dropdown for type of employment
		$data['permanent_options'] = $this->options->type_employment();

		$data['permanent_options_selected'] = $employee_info['permanent'];
		$data['first_day_of_service'] 		= $employee_info['first_day_of_service'];
		$data['position'] 					= $employee_info['position'];
		$data['assistant_dept_head'] 		= $employee_info['assistant_dept_head'];
		$data['employee_id'] 				= $employee_info['employee_id'];
		
		$data['friday_exempted'] 			= $employee_info['friday_exempted'];
		
		
		
		//Salary grade options
		$data['sg_options'] = $this->options->salary_grade();
		
		
		//step increment
		$data['step_options'] = $this->options->step();
		
		$data['sg_selected'] = $employee_info['salary_grade'];
		
		$data['step_selected'] = $employee_info['step'];
		
		$data['page']			= $this->uri->segment(5);
		$data['office_return']	= $this->uri->segment(4);
		
		$data['image_file_name'] = $employee_info['pics'];
		
		//Shift List
		$data['shifts_options'] 	= $this->options->shift();
		
		$data['shift2'] 	= $employee_info['shift_id'];
		
		if ($employee_info['pics'] == '' || !file_exists('pics/'.$employee_info['pics']))
		{
			$data['image_file_name'] = 'not_available.jpg';
		}
		
		$data['id'] 		= $employee_info['id'];
		$data['salutation'] = $employee_info['salut'];
		$data['lname'] 		= $employee_info['lname'];
		$data['fname'] 		= $employee_info['fname'];
		$data['mname'] 		= $employee_info['mname'];
		$data['extension'] 	= $employee_info['extension'];
		
		//The original employee id
		$data['orig_id'] = $employee_info['id'];
		
		$data['emergency_contact'] = $employee_info['emergency_contact'];
		$data['emergency_contact_no'] = $employee_info['emergency_contact_no'];
						
		if (Input::get('op'))
		{			
			$orig_id 		= Input::get('orig_id');
			
			$id 			= Input::get('id');
			
			if ($employee_id != Input::get('employee_id'))
			{
				$this->form_validation->set_rules('employee_id', 'Employee ID', 'required|callback_employee_id_check');
			}
			
			$this->form_validation->set_rules('salutation', 'Salutation', 'required');
			$this->form_validation->set_rules('lname', 'Last Name', 'required');
			$this->form_validation->set_rules('fname', 'First Name', 'required');
			$this->form_validation->set_rules('position', 'Position', 'required');
			$this->form_validation->set_rules('extension', 'First Name', '');
			$this->form_validation->set_rules('permanent', 'Type of employment', 'required');
			
			if ($this->form_validation->run($this) == FALSE)
			{
				$data['selected'] 			= Input::get('office_id');
				$data['detailed_selected'] 	= Input::get('detailed_office_id');
				$data['employee_id'] 		= Input::get('employee_id');
				$data['page']				= Input::get('page');
				$data['office_return']		= Input::get('office_return');
			}
			else
			{
				if (Input::get('employee_id') != $employee_info['employee_id']) {
					
					$em = new Employee_m();
					$em->get_by_id($orig_id);
					$em->orig_id = $employee_info['employee_id'];
					$em->save();
					# code...
				}
				//echo $orig_id;

				//echo Input::get('employee_id');
				//var_dump($employee_info['employee_id']);
				//var_dump($employee_info['orig_id']);
				//exit;

				$info = array(
						'employee_id' 			=> Input::get('employee_id'),
						'lname' 				=> Input::get('lname'),
						'fname' 				=> Input::get('fname'),
						'mname' 				=> Input::get('mname'),
						'extension' 			=> Input::get('extension'),
						'office_id' 			=> Input::get('office_id'),
						'division_id' 			=> Input::get('division_id'),
						'section_id' 			=> Input::get('section_id'),
						'detailed_office_id' 	=> Input::get('detailed_office_id'),
						'salut' 				=> Input::get('salutation'),
						'permanent' 			=> Input::get('permanent'),
						'first_day_of_service' 	=> Input::get('first_day_of_service'),
						'salary_grade' 			=> Input::get('sg'),
						'step'					=> Input::get('step'),
						'position' 				=> Input::get('position'),
						'assistant_dept_head' 	=> Input::get('assistant_dept_head'),
						'shift_id' 				=> Input::get('shift2'),
						'shift_type' 			=> Input::get('shift2'),
						'friday_exempted' 		=> Input::get('friday_exempted'),
						'updated' 				=> 1,
						'emergency_contact'		=> Input::get('emergency_contact'),
						'emergency_contact_no'	=> Input::get('emergency_contact_no'),
						
						);
				
				
				
				//$data['emergency_contact'] = $employee_info['emergency_contact'];
				
				//File name of the photo
				$file_register = Session::get('file_register');
						
				if ($file_register)
				{
					$info['pics'] = $file_register;
										
					$info['finger_pics'] = '/../'.current_work_dir().'/pics/'.Session::get('file_register');
				}
				
				$this->Employee->update_employee($info, $id);
				
				$this->Logs->insert_logs('employees', 
										 'EDIT EMPLOYEE', 
										 'Edit employee ('.$id.')', 
										 $id
										 );
				
				
				$page			= Input::get('page');
				$office_return	= Input::get('office_return');
				
				// Use for messaging
				Session::flash('msg', 'Employee updated!');
				
				return Redirect::to('employees/index/'.$page.'/'.$office_return, 'refresh');
			}
			
			
		}
				
		$data['main_content'] = 'edit_employee';
		
		return View::make('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function delete_employee($employee_id, $page, $office_return)
	{
		$this->Employee->delete_employee($employee_id);
		
		// Use for messaging
		Session::flash('msg', 'Employee deleted!');
		
		$this->Logs->insert_logs(
									'employees', 
									'DELETE EMPLOYEE', 
									'', 
									$employee_id
									);
		
		return Redirect::to('employees/index/'.$office_return.'/'.$page, 'refresh');
	}
	
	// --------------------------------------------------------------------
	
	function step_increment()
	{
		$data['page_name'] = '<b>Employee Step Increment</b>';
		
		$data['msg'] 				= '';
		
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= (	Input::get('office_id') ) ? 
										Input::get('office_id') : 
										Session::get('office_id');
		
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= (	Input::get('month') ) ? 
										Input::get('month') :
										date('m');
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= (	Input::get('year') ) ? 
										Input::get('year') :
										date('Y');
										
		if (Input::get('op'))
		{
			echo 'ok';
		}								
			
		
		$data['main_content'] = 'step_increment';
		
		return View::make('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check if emmployee id exists
	 *
	 * @param string $employee_id
	 * @return boolean
	 */
	function employee_id_check($employee_id)
	{
		$is_employee_id_exists = $this->Employee->is_employee_id_exists($employee_id);
		
		if ($is_employee_id_exists == TRUE)
		{
			$this->form_validation->set_message('employee_id_check', 'The Employee ID exists!');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	// --------------------------------------------------------------------	
}	
include('id_preview.php');
/* End of file employees.php */
/* Location: ./application/modules/employees/controllers/employees.php */