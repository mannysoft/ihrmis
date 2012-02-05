<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_manage extends MX_Controller  {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		//$this->output->enable_profiler(TRUE);
		
		//$this->load->add_package_path('c:/xampp/htdocs/system_common/foo_bar');
		
		$this->load->model('options');
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
		$data['selected'] 			= $this->session->userdata('office_id');
		
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
		
		$op 						= $this->input->post('op');
		
		//If form submit
		if($op == 1)
		{
			
			$this->form_validation->set_rules('employee_id', 'Employee ID', 'required|callback_employee_id_check');
			$this->form_validation->set_rules('salutation', 'Salutation', 'required');
			$this->form_validation->set_rules('lname', 'Last Name', 'required');
			$this->form_validation->set_rules('fname', 'First Name', 'required');
			$this->form_validation->set_rules('position', 'Position', 'required');
			$this->form_validation->set_rules('permanent', 'Type of employment', 'required');
			//$this->form_validation->set_rules('password', 'Password', 'required|matches[repassword]');
			
			if ($this->form_validation->run($this) == FALSE)
			{
				$data['selected'] 			= $this->input->post('office_id');
				$data['detailed_selected'] 	= $this->input->post('detailed_office_id');
				$data['permanent_selected'] = $this->input->post('permanent');
				$data['sg_selected'] 		= $this->input->post('sg');
				$data['step_selected'] 		= $this->input->post('step');
			}
			else
			{
			
				$shift_id 				= $this->input->post('shift2');
				$shift_type 			= $this->input->post('shift2');
	
				//If other shift if selected
				if($this->input->post('hour1'))
				{
					$hour1 		= $this->input->post('hour1');
					$minute1 	= $this->input->post('minute1');
					$am_pm1 	= $this->input->post('am_pm1');
					$hour2 		= $this->input->post('hour2');
					$minute2 	= $this->input->post('minute2');
					$am_pm2 	= $this->input->post('am_pm2');
					
					$times = $hour1.':'.$minute1.','.$am_pm1.',';
					$times.= $hour2.':'.$minute2.','.$am_pm2;
					
					$row = $this->Shift->shift_details($times);
					
					if (!empty($row))
					{
						$shift_id 	= $row['shift_id'];
						$shift_type = $row['shift_type'];
					}
					else
					{
						if($am_pm1 == 'AM' && $am_pm2 == 'PM')
						{
							$shift_type 	= 2;
						}
						
						if($am_pm1 == 'PM' && $am_pm2 == 'PM')
						{
							$shift_type 	= 2;
						}
						
						if($am_pm1 == 'PM' && $am_pm2 == 'AM')
						{
							$shift_type 	= 3;
						}
						
						
						$hour1 = $hour1.':'.$minute1.','.$am_pm1;
						$hour2 = $hour2.':'.$minute2.','.$am_pm2;
						
						if($hour1 == $hour2)
						{
							$shift_type = 4;
						}
						
						//insert to table shift
						
						//insert to table shift and get the ID
						$shift_id = $this->Shift->add_shift($this->session->userdata('office_id'), $shift_type, $times);
						
						$shift_type = $shift_type;
					
					}
			
				}
				
				//File name of the photo
				$file_register = $this->session->userdata('file_register');
				$finger_pics = '/../atlms/pics/'.$this->session->userdata('file_register');
				
				$info = array(
				'employee_id' 			=> $this->input->post('employee_id'),
				'lname' 				=> $this->input->post('lname'),
				'fname' 				=> $this->input->post('fname'),
				'mname' 				=> $this->input->post('mname'),
				'position' 				=> $this->input->post('position'),
				'assistant_dept_head' 	=> $this->input->post('assistant_dept_head'),
				'office_id' 			=> $this->input->post('office_id'),
				'detailed_office_id'	=> $this->input->post('detailed_office_id'),
				'salut'					=> $this->input->post('salutation'),
				'pics' 					=> $file_register,
				'finger_pics' 			=> $finger_pics,
				'shift_id' 				=> $shift_id,
				'shift_type' 			=> $shift_type,
				'status' 				=> 1,
				'permanent' 			=> $this->input->post('permanent'),
				'first_day_of_service' 	=> $this->input->post('first_day_of_service'),
				'salary_grade' 			=> $this->input->post('sg'),
				'step'					=> $this->input->post('step'),
				'newly_added' 			=> 1,
				'updated'				=> 1
				);
		
				$id = $this->Employee->add_employee($info);
				
				$this->Logs->insert_logs($this->session->userdata('username'), 
										 $this->session->userdata('office_id'), 
										'ADD EMPLOYEE', 
										'Add new employee ('.$id.')', 
										$id);
										
				// Use for messaging
				$this->session->set_flashdata('msg', 'New Employee added!');
				
				if ($this->config->item('active_apps') == 'hris')
				{
					// Add to personal info
					$p = new Orm_personal();
					
					$p->get_by_employee_id( $id );
					
					$p->employee_id		= $id;
					$p->lname			= $this->input->post('lname');
					$p->fname			= $this->input->post('fname');
					$p->mname			= $this->input->post('mname');
					
					$p->save(); 
					
					
					
					// Redirect to pds page
					//redirect(base_url().'pds/employee_profile/'.$id, 'refresh');		
				}
				
				// Redirect to adding new employee form
				redirect(base_url().'employee_manage/add_employee', 'refresh');				
			}
					
		}
		
		$data['main_content'] = 'add_employee';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Enter description here...
	 *
	 */
	function list_employee()
	{

		$data['page_name'] = '<b>Employee List</b>';
		$data['msg'] = '';
		
		$off = $this->uri->segment(4, 0);
		
		//echo $this->uri->uri_string();
		
		//echo $off;
		if ($off == 0)
		{
			$office_id = $this->session->userdata('office_id');
			$data['selected'] = $this->session->userdata('office_id');
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
		
		$config['base_url'] = base_url().'employee_manage/list_employee';
		$config['total_rows'] = $this->Employee->num_rows;
		$config['office_id'] = $office_id; //add ko
	    $config['per_page'] = '15';
	    $config['full_tag_open'] = '<p>';
	    $config['full_tag_close'] = '</p>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		
		$employee_id = '';
		
		//http://localhost/hris/user_guide/libraries/uri.html
		
		$this->mi_pagination->initialize($config);
		
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
		$op = $this->input->post('op');
		
		//if form submit
		if($op == 1)
		{
			$employees = $this->input->post('employee');
			
			if(is_array($employees))
			{
				foreach($employees as $employee)
				{
					$action = $this->input->post('action');
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
			
			$office_id 		= $this->input->post('office_id');
			$employee_id 	= $this->input->post('employee_id');
			$lname 			= $this->input->post('lname');
			
			$this->Employee->get_employee_list($office_id, $employee_id);
			
			$config['base_url'] = base_url().'employee_manage/list_employee/';
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
			
			
			
			$data['selected'] = $this->input->post('office_id');
		
		}
		
		$data['page'] = $this->uri->segment(3, 0);
		
		$this->mi_pagination->initialize($config);
				
		$data['main_content'] = 'list_employee';
		
		$this->load->view('includes/template', $data);
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
										'office_id',
										'detailed_office_id',
										'permanent',
										'first_day_of_service',
										'position',
										'assistant_dept_head',
										'employee_id',
										'salary_grade',
										'step',
										'pics',
										'id',
										'salut',
										'lname',
										'fname',
										'mname'
										);
		
		$employee_info = $this->Employee->get_employee_info($employee_id);
		
		if ($employee_id == '')
		{
			$employee_info = $this->Employee->get_employee_info($this->input->post('orig_id'));
		}
		
		$shift_id_from_select = $employee_info['shift_id'];
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		$data['selected'] = $employee_info['office_id'];
		
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
		
		if ($employee_info['pics'] == '' || !file_exists('pics/'.$employee_info['pics']))
		{
			$data['image_file_name'] = 'not_available.jpg';
		}
		
		$data['id'] 		= $employee_info['id'];
		$data['salutation'] = $employee_info['salut'];
		$data['lname'] 		= $employee_info['lname'];
		$data['fname'] 		= $employee_info['fname'];
		$data['mname'] 		= $employee_info['mname'];
		
		//The original employee id
		$data['orig_id'] = $employee_info['id'];
		
		$op = $this->input->post('op');
		
		if ($op == 1)
		{
			//$employee_id 	= $this->input->post('employee_id');
			
			$orig_id 		= $this->input->post('orig_id');
			
			$id 			= $this->input->post('id');
			
			if ($employee_id != $this->input->post('employee_id'))
			{
				$this->form_validation->set_rules('employee_id', 'Employee ID', 'required|callback_employee_id_check');
			}
			
			$this->form_validation->set_rules('salutation', 'Salutation', 'required');
			$this->form_validation->set_rules('lname', 'Last Name', 'required');
			$this->form_validation->set_rules('fname', 'First Name', 'required');
			$this->form_validation->set_rules('position', 'Position', 'required');
			$this->form_validation->set_rules('permanent', 'Type of employment', 'required');
			
			if ($this->form_validation->run($this) == FALSE)
			{
				$data['selected'] 			= $this->input->post('office_id');
				$data['detailed_selected'] 	= $this->input->post('detailed_office_id');
				$data['employee_id'] 		= $this->input->post('employee_id');
				$data['page']				= $this->input->post('page');
				$data['office_return']		= $this->input->post('office_return');
			}
			else
			{
				$info = array(
						'employee_id' 			=> $this->input->post('employee_id'),
						'lname' 				=> $this->input->post('lname'),
						'fname' 				=> $this->input->post('fname'),
						'mname' 				=> $this->input->post('mname'),
						'office_id' 			=> $this->input->post('office_id'),
						'detailed_office_id' 	=> $this->input->post('detailed_office_id'),
						'salut' 				=> $this->input->post('salutation'),
						'permanent' 			=> $this->input->post('permanent'),
						'first_day_of_service' 	=> $this->input->post('first_day_of_service'),
						'salary_grade' 			=> $this->input->post('sg'),
						'step'					=> $this->input->post('step'),
						'position' 				=> $this->input->post('position'),
						'assistant_dept_head' 	=> $this->input->post('assistant_dept_head'),
						'shift_id' 				=> $this->input->post('shift2'),
						'shift_type' 			=> $this->input->post('shift2'),
						'updated' 				=> 1
						);
				
				//File name of the photo
				$file_register = $this->session->userdata('file_register');
						
				if ($file_register)
				{
					$info['pics'] = $file_register;
					$info['finger_pics'] = '/../atlms/pics/'.$this->session->userdata('file_register');
				}
				
				$this->Employee->update_employee($info, $id);
				
				$this->Logs->insert_logs($this->session->userdata('username'), 
										 $this->session->userdata('office_id'), 
										 'EDIT EMPLOYEE', 
										 'Edit employee ('.$id.')', 
										 $id
										 );
				
				
				$page			= $this->input->post('page');
				$office_return	= $this->input->post('office_return');
				
				// Use for messaging
				$this->session->set_flashdata('msg', 'Employee updated!');
				
				redirect(base_url().'employee_manage/list_employee/'.$page.'/'.$office_return, 'refresh');
			}
			
			
		}
				
		$data['main_content'] = 'edit_employee';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Enter description here...
	 * @since version 1.76
	 *
	 */
	function employee_profile($employee_id = '')
	{

		$data['page_name'] = '<b>Employee Profile</b>';
		
		$data['msg'] = '';
		
		$data['employee'] = $this->Employee->get_employee_info($employee_id);
		
		$data['main_content'] = 'employee_profile';
		
		$this->load->view('includes/template', $data);
		
	}
	
	function modal_edit_employee($employee_id = '')
	{
		$data = array();
		
		
		//After form  submit============================================================================================================
		//==============================================================================================================================
		if (isset($_POST['op']))
		{
			//DO the adding execute all function for adding
	
			//====================================
			list($month, $day, $year) = split('[/.-]', $_POST['birth_date']);
			
			$birth_date = $year.'-'.$month.'-'.$day;
			
			$personal_data = array(
			
			'lname' 			=> $_POST['lname'],
			'fname' 			=> $_POST['fname'],
			'mname' 			=> $_POST['mname'],
			'extension' 		=> $_POST['extension'],
			'birth_date' 		=> $_POST['birth_date'],
			'birth_place'		=> $_POST['birth_place'],
			'sex'				=> $_POST['sex'],
			'civil_status'		=> $_POST['civil_status'],
			'citizenship'		=> $_POST['citizenship'],
			'height'			=> $_POST['height'],
			'weight'			=> $_POST['weight'],
			'blood_type'		=> $_POST['blood_type'],
			'gsis'				=> $_POST['gsis'],
			'pagibig'			=> $_POST['pagibig'],
			'philhealth'		=> $_POST['philhealth'],
			'sss'				=> $_POST['sss'],
			'res_address'		=> $_POST['res_address'],
			'res_zip'			=> $_POST['res_zip'],
			'res_tel'			=> $_POST['res_tel'],
			'permanent_address' => $_POST['permanent_address'],
			'permanent_zip'		=> $_POST['permanent_zip'],
			'permanent_tel' 	=> $_POST['permanent_tel'],
			'email'				=> $_POST['email'],
			'cp'				=> $_POST['cp'],
			'agency_employee_no'=> $_POST['agency_employee_no'],
			'tin'				=> $_POST['tin']
			
			);
			
			// Update personal info
			$this->db->where('id', $this->input->post('employee_id'));
			$this->db->update('personal_info', $personal_data); 
			
			$employeeId = $this->input->post('employee_id');

			
			//FAMILY BACKGROUND=======================================================
			$family_data = array(
			
			'employee_id' 		=> $employeeId,
			'spouse_lname' 		=> $_POST['spouse_lname'],
			'spouse_fname' 		=> $_POST['spouse_fname'],
			'spouse_mname' 		=> $_POST['spouse_mname'],
			'spouse_occupation' => $_POST['spouse_occupation'],
			'spouse_employer'	=> $_POST['spouse_employer'],
			'spouse_biz_ad'		=> $_POST['spouse_biz_ad'],
			'spouse_tel'		=> $_POST['spouse_tel'],
			'father_lname'		=> $_POST['father_lname'],
			'father_fname'		=> $_POST['father_fname'],
			'father_mname'		=> $_POST['father_mname'],
			'mother_lname'		=> $_POST['mother_lname'],
			'mother_fname'		=> $_POST['mother_fname'],
			'mother_mname'		=> $_POST['mother_mname']
			
			);
			
			//Delete family background
			$this->Family_Background->delete_family_background($this->input->post('employee_id'));
			
			//Insert to family_background table
			$this->Family_Background->addFamilyBackground($family_data);
			
			//CHILDREN===================================
			$children 			= $_POST['children'];
			$children_birth_day	= $_POST['children_birth_day'];
			
			
			//Delete children
			$this->Children->delete_children($this->input->post('employee_id'));
			
			$i = 0;
			
			foreach ($children as $child)
			{
				if ($child != "")
				{
					//list($month, $day, $year) = split('[/.-]', $children_birth_day[$i]);
					
					//$birth_date = $year.'-'.$month.'-'.$day;
					
					$childData = array(
						
						'employee_id' 	=> $employeeId,
						'children'		=> $children[$i],
						'birth_date'	=> $children_birth_day[$i]
						);
						
						//Insert to children
						$this->Children->addChildren($childData);
				
				}
				
				$i++;
			}
			
			//EDUCATIONAL BACKGROUND============================================
			
			//ELEMENTARY
			if ($_POST['elem_school'] != "")
			{
				$educData = array(
						
				'employee_id' 	=> $employeeId,
				'level'			=> 1,
				'school_name'	=> $_POST['elem_school'],
				'degree_course' => $_POST['elem_degree'],
				'year_graduated'=> $_POST['elem_grad'],
				'highest_grade'	=> $_POST['elem_units'],
				'attend_from' 	=> $_POST['elem_date1'],
				'attend_to'		=> $_POST['elem_date2'],
				'scholarship'	=> $_POST['elem_scho'],
				);
				
				//Delete Educational_Background
				$this->Educational_Background->delete_education_background($this->input->post('employee_id'), $level = 1);
						
				//Insert Educational_Background
				$this->Educational_Background->addEducBackground($educData);
			}
			
			//HIGHSCHOOL
			if ($_POST['sec_school'] != "")
			{
				$educData = array(
						
				'employee_id' 	=> $employeeId,
				'level'			=> 2,
				'school_name'	=> $_POST['sec_school'],
				'degree_course' => $_POST['sec_degree'],
				'year_graduated'=> $_POST['sec_grad'],
				'highest_grade'	=> $_POST['sec_units'],
				'attend_from' 	=> $_POST['sec_date1'],
				'attend_to'		=> $_POST['sec_date2'],
				'scholarship'	=> $_POST['sec_scho'],
				);
				
				//Delete Educational_Background
				$this->Educational_Background->delete_education_background($this->input->post('employee_id'), $level = 2);
						
				//Insert Educational_Background
				$this->Educational_Background->addEducBackground($educData);
			}
			
			//VOC
			if ($_POST['voc_school'] != "")
			{
				$educData = array(
						
				'employee_id' 	=> $employeeId,
				'level'			=> 3,
				'school_name'	=> $_POST['voc_school'],
				'degree_course' => $_POST['voc_degree'],
				'year_graduated'=> $_POST['voc_grad'],
				'highest_grade'	=> $_POST['voc_units'],
				'attend_from' 	=> $_POST['voc_date1'],
				'attend_to'		=> $_POST['voc_date2'],
				'scholarship'	=> $_POST['voc_scho'],
				);
				
				//Delete Educational_Background
				$this->Educational_Background->delete_education_background($this->input->post('employee_id'), $level = 3);
						
				//Insert Educational_Background
				$this->Educational_Background->addEducBackground($educData);
			}
			
			//COLLEGE
			if ($_POST['col_school'] != "")
			{
				$educData = array(
						
				'employee_id' 	=> $employeeId,
				'level'			=> 4,
				'school_name'	=> $_POST['col_school'],
				'degree_course' => $_POST['col_degree'],
				'year_graduated'=> $_POST['col_grad'],
				'highest_grade'	=> $_POST['col_units'],
				'attend_from' 	=> $_POST['col_date1'],
				'attend_to'		=> $_POST['col_date2'],
				'scholarship'	=> $_POST['col_scho'],
				);
				
				//Delete Educational_Background
				$this->Educational_Background->delete_education_background($this->input->post('employee_id'), $level = 4);
						
				//Insert Educational_Background
				$this->Educational_Background->addEducBackground($educData);
			}
			
			//GRAD SCHOOL
			if ($_POST['grad_school'] != "")
			{
				$educData = array(
						
				'employee_id' 	=> $employeeId,
				'level'			=> 5,
				'school_name'	=> $_POST['grad_school'],
				'degree_course' => $_POST['grad_degree'],
				'year_graduated'=> $_POST['grad_grad'],
				'highest_grade'	=> $_POST['grad_units'],
				'attend_from' 	=> $_POST['grad_date1'],
				'attend_to'		=> $_POST['grad_date2'],
				'scholarship'	=> $_POST['grad_scho'],
				);
				
				//Delete Educational_Background
				$this->Educational_Background->delete_education_background($this->input->post('employee_id'), $level = 5);
						
				//Insert Educational_Background
				$this->Educational_Background->addEducBackground($educData);
			}
			
			
			//SERVICE ELIGIBILITY=================================
			$types 					= $_POST['type'];
			$rating 				= $_POST['rating'];
			$date_exam_conferment 	= $_POST['date_exam_conferment'];
			$place_exam_conferment 	= $_POST['place_exam_conferment'];
			$license_no 			= $_POST['license_no'];
			$license_release_date 	= $_POST['license_release_date'];
			
			//Delete Eligibility
			$this->Eligibility->delete_eligibility($this->input->post('employee_id'));
			
			$i = 0;
			
			foreach ($types as $type)
			{
				if ($type != "")
				{
				
					$serviceData = array(
						
						'employee_id' 			=> $employeeId,
						'type' 					=> $types[$i],
						'rating' 				=> $rating[$i],
						'date_exam_conferment' 	=> $date_exam_conferment[$i],
						'place_exam_conferment'	=> $place_exam_conferment[$i],
						'license_no'			=> $license_no[$i],
						'license_release_date'	=> $license_release_date[$i]
						);
						
						//Insert to house_hold
						$this->Eligibility->addEligibility($serviceData);
				
				}
				
				$i++;
			}
			
			//WORK EXPERIENCE=================================
			$work_date1 	= $_POST['work_date1'];
			$work_date2 	= $_POST['work_date2'];
			$work_position 	= $_POST['work_position'];
			$work_office 	= $_POST['work_office'];
			$work_salary 	= $_POST['work_salary'];
			$work_sg 		= $_POST['work_sg'];
			$work_status 	= $_POST['work_status'];
			$work_service 	= $_POST['work_service'];
			
			//Delete work
			$this->Work_Experience->delete_work_experience($this->input->post('employee_id'));
			
			$i = 0;
			
			foreach ($work_date1 as $work_date)
			{
				if ($work_date != "")
				{
				
					$workData = array(
						'employee_id' 			=> $employeeId,
						'inclusive_date_from' 	=> $work_date1[$i],
						'inclusive_date_to' 	=> $work_date2[$i],
						'position' 				=> $work_position[$i],
						'company'				=> $work_office[$i],
						'monthly_salary'		=> $work_salary[$i],
						'salary_grade'			=> $work_sg[$i],
						'status'				=> $work_status[$i],
						'govt_service'			=> $work_service[$i]
						);
						
						//Insert to work
						$this->Work_Experience->addWork($workData);
				
				}
				
				$i++;
			}
			
			//VOLUNTARY WORK OR INVOLVEMENT=========================
			$org_name 					= $_POST['org_name'];
			$org_inclusive_date_from 	= $_POST['org_inclusive_date_from'];
			$org_inclusive_date_to 		= $_POST['org_inclusive_date_to'];
			$org_number_of_hours 		= $_POST['org_number_of_hours'];
			$org_position 				= $_POST['org_position'];
			
			//Delete org
			$this->Organization->delete_organization($this->input->post('employee_id'));
			
			$i = 0;
			
			foreach ($org_name as $org)
			{
				if ($org != "")
				{
				
					$orgData = array(
						'employee_id' 			=> $employeeId,
						'name' 					=> $org_name[$i],
						'inclusive_date_from' 	=> $org_inclusive_date_from[$i],
						'inclusive_date_to' 	=> $org_inclusive_date_to[$i],
						'number_of_hours'		=> $org_number_of_hours[$i],
						'position'				=> $org_position[$i]
						);
						
						//echo $work_date2[$i];
						//Insert to organization
						$this->Organization->add_org($orgData);
				
				}
				
				$i++;
			}
			
			//TRAINING PROGRAMS=========================
			$tra_name 		= $_POST['tra_name'];
			$tra_date_from 	= $_POST['tra_date_from'];
			$tra_date_to 	= $_POST['tra_date_to'];
			$tra_hours 		= $_POST['tra_hours'];
			$tra_conduct 	= $_POST['tra_conduct'];
			$tra_location 	= $_POST['tra_location'];
			
			//Delete training
			$this->Training->delete_training($this->input->post('employee_id'));
			
			$i = 0;
			
			foreach ($tra_name as $tra)
			{
				if ($tra != "")
				{
				
					$traData = array(
						'employee_id' 	=> $employeeId,
						'name' 			=> $tra_name[$i],
						'date_from' 	=> $tra_date_from[$i],
						'date_to' 		=> $tra_date_to[$i],
						'number_hours'	=> $tra_hours[$i],
						'conducted_by'	=> $tra_conduct[$i],
						'location'		=> $tra_location[$i]
						);
						
						//echo $work_date2[$i];
						//Insert to Training
						$this->Training->addTraining($traData);
				
				}
				
				$i++;
			}
			
			//OTHER INFORMATION=========================
			$skills 					= $_POST['skill'];
			$recognition 				= $_POST['recognition'];
			$membership_organization 	= $_POST['membership_organization'];
			
			//Delete other info
			$this->Other_Info->delete_other_info($this->input->post('employee_id'));
			
			$i = 0;
			
			foreach ($skills as $skill)
			{
				//if ($skill != "")
				//{
				
					$skilldata = array(
						'employee_id' 	 			=> $employeeId,
						'special_skills' 			=> $skills[$i],
						'recognition' 				=> $recognition[$i],
						'membership_organization'	=> $membership_organization[$i]
						);
						
						//Insert to Other_Info
						$this->Other_Info->addInfo($skilldata);
				//}
				
				$i++;
			}
			
			//QUESTIONS=======================================
			$questions 	= $_POST['q'];
			$answer 	= $_POST['q'];
			$details 	= $_POST['details'];
			
			//Delete Questions
			$this->Questions->delete_questions($this->input->post('employee_id'));
			
			$i = 0;
			$count = 0;
			//echo count($questions);
			foreach ($questions as $question)
			{
				$count +=1;
				
				$qdata = array(
						'employee_id' => $employeeId,
						'question_no' => $count,
						'answer' 	  => $answer[$i],
						'details'	  => $details[$i]
						);
				
				$this->Questions->insert_answer($qdata);
				
				$i++;
			}
			
			//REFERENCE
			$names 	 = $_POST['ref_name'];
			$address = $_POST['ref_address'];
			$no 	 = $_POST['ref_tel'];
			
			//Delete References
			$this->References->delete_references($this->input->post('employee_id'));
			
			$i = 0;
			
			foreach ($names as $name)
			{
				
				$rdata = array(
						'employee_id' => $employeeId,
						'name' 		  => $names[$i],
						'address' 	  => $address[$i],
						'tel_no'	  => $no[$i]
						);
				
				$this->References->insert_ref($rdata);
				
				$i++;
			}
			
			
			//PROFILE
			$rdata = array(
						'employee_id'	 => $employeeId,
						'item_number' 	 => $_POST['profile_item_number'],
						'position' 	     => $_POST['profile_position'],
						'department'	 => $_POST['profile_department'],
						'salary_grade' 	 => $_POST['profile_salary_grade'],
						'salary' 		 => $_POST['profile_salary'],
						'status' 	  	 => $_POST['profile_status'],
						'last_promotion' => $_POST['profile_last_promotion'],
						'level'			 => $_POST['profile_level'],
						'eligibility' 	 => $_POST['profile_eligibility'],
						'first_day' 	 => $_POST['profile_first_day'],
						'graduated'	  	 => $_POST['profile_graduated'],
						'course'  		 => $_POST['profile_course'],
						'units' 		 => $_POST['profile_units'],
						'post_grad' 	 => $_POST['profile_post_grad']
						);
						
			//delete
			$this->Profile->delete_profile($this->input->post('employee_id'));
						
			$this->Profile->insert_profile($rdata);
			
			//tell if the employee record has been saved
			$data['saved'] = 1;
			
			$employee_id = $this->input->post('employee_id');
		}
		
		
		
		//End form submit================================================================================================================
		//===============================================================================================================================
		
		
		
		//Personal Info=================================================================
		$data['personal'] = $this->Personal_Info->get_personal_info($employee_id);
		
		$data['sex_options'] = array('M'  => 'Male','F'  => 'Female');
		
		$data['civil_status_options'] = array(
												'1'  => 'Single',
												'2'  => 'Married',
												'3'  => 'Annulled',
												'4'  => 'Widowed',
												'5'  => 'Separated',
												'6'  => 'Others'
												);	
										
		
		
		//Family background=============================================================
		$data['family'] = $this->Family_Background->get_family_background($employee_id);
		
		
		//children======================================================================
		$children = $this->Children->get_child($employee_id);
		
		$i = 0;
		
		foreach ($children as $child)
		{
			$data['children']['name'][] = $child['children'];
			$data['children']['birth_date'][] 	= $child['birth_date'];
			
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
		
		//Educational Background============================================================
		$data['educs1'] = $this->Educational_Background->get_single_educ($employee_id, $level = 1);
		$data['educs2'] = $this->Educational_Background->get_single_educ($employee_id, $level = 2);
		$data['educs3'] = $this->Educational_Background->get_single_educ($employee_id, $level = 3);
		$data['educs4'] = $this->Educational_Background->get_single_educ($employee_id, $level = 4);
		$data['educs5'] = $this->Educational_Background->get_single_educ($employee_id, $level = 5);
		
		
		//Service===========================================================================
		$services = $this->Eligibility->get_eligibility($employee_id);
		
		$i = 0;
		
		foreach ($services as $service)
		{
			$data['services']['type'][] 					= $service['type'];
			$data['services']['rating'][] 					= $service['rating'];
			$data['services']['date_exam_conferment'][] 	= $service['date_exam_conferment'];
			$data['services']['place_exam_conferment'][] 	= $service['place_exam_conferment'];
			$data['services']['license_no'][] 				= $service['license_no'];
			$data['services']['license_release_date'][] 	= $service['license_release_date'];
			
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
		
		
		//work=================================================================
		$data['works'] = $this->Work_Experience->get_work($employee_id);
		
		$data['govt_service_options'] = array(
										  '1'  => 'Yes',
										  '0'  => 'No'
										);


		//voluntary work or involvement ======================================
		$data['orgs'] = $this->Organization->get_org($employee_id);
		
		
		//training===========================================================
		$data['trains'] = $this->Training->get_training($employee_id);
		$data['tra_location_options'] = array(
										  'local'  			=> 'Local',
										  'regional'  		=> 'Regional',
										  'national'		=> 'National',
										  'international'	=> 'International'
										);
		
		//other information==================================================
		$data['infos'] = $this->Other_Info->get_other_info($employee_id);
		
		
		//question ===========================================================
		$data['question_options'] = array(
										  '0'  => 'No',
										  '1'  => 'Yes'
										);
		
		$data['question1'] = $this->Questions->get_question($employee_id, $question_no = 1);
		$data['question2'] = $this->Questions->get_question($employee_id, $question_no = 2);
		$data['question3'] = $this->Questions->get_question($employee_id, $question_no = 3);
		$data['question4'] = $this->Questions->get_question($employee_id, $question_no = 4);
		$data['question5'] = $this->Questions->get_question($employee_id, $question_no = 5);
		$data['question6'] = $this->Questions->get_question($employee_id, $question_no = 6);
		$data['question7'] = $this->Questions->get_question($employee_id, $question_no = 7);
		$data['question8'] = $this->Questions->get_question($employee_id, $question_no = 8);
		
		
		//references==========================================================
		$data['references'] = $this->References->get_references($employee_id);
		
		//profile=============================================================
		$data['profile'] = $this->Profile->get_profile($employee_id);
		
		$data['employee_id'] = $employee_id;
		
		$this->load->view('modal/edit_employee', $data);
		
		
	}
	
	// --------------------------------------------------------------------
	
	function delete_employee($employee_id, $page, $office_return)
	{
		$this->Employee->delete_employee($employee_id);
		
		// Use for messaging
		$this->session->set_flashdata('msg', 'Employee deleted!');
		
		redirect(base_url().'employee_manage/list_employee/'.$office_return.'/'.$page, 'refresh');
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
	
	
}	

/* End of file employee_manage.php */
/* Location: ./application/modules/employee_manage/controllers/employee_manage.php */