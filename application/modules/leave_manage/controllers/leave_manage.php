<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leave_Manage extends MX_Controller {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		//$this->output->enable_profiler(TRUE);
    }  
	
	function approved_leave($leave_apps_id = '')
	{
		/*
		$leave_apps = $Leave_Apps->get_leave_apps_info($_GET['leave_apps_id']);
	
		$_GET['employee_id'] 	= $leave_apps['employee_id'];
		$_GET['multiple']	 	= $leave_apps['details'];
		$_GET['month']	 		= $leave_apps['month'];
		$_GET['year']	 		= $leave_apps['year'];
		$_GET['leave_type_id']	= $leave_apps['leave_type_id'];
		$_GET['special_priv_id']= $leave_apps['special_priv_id'];
		$_GET['days']	 		= $leave_apps['days'];
		$_GET['mone']	 		= $leave_apps['details'];
		$_GET['process']	 	= 1;
		
		//set the leave to approved
		$Leave_Apps->set_approved($_GET['leave_apps_id']);
		*/
		redirect(base_url().'leave_manage/leave_apps', 'refresh');
		//echo 'ok';
		
	}
	
	// --------------------------------------------------------------------
	
	function cancel_leave($id, $employee_id, $csc = '', $cpo = '')
	{
		if ($csc == 0)
		{	
			$csc = '';
		}
		if ($cpo == 0)
		{	
			$cpo = '';
		}
		
		$this->Dtr->cancel_leave($id, $employee_id, $csc, $cpo);
		
		$this->session->set_flashdata('msg', 'Leave has been cancelled!');
		
		redirect(base_url().'leave_manage/file_leave/'.$employee_id, 'refresh');
	}
	
	// --------------------------------------------------------------------
	
	function cancel_leave_apps($id = '')
	{
		$this->Leave_apps->delete_leave_apps($id);	
	}
	
	// --------------------------------------------------------------------
	
	function cancel_undertime($id = '', $employee_id = '')
	{
		
		$this->Leave_card->cancel_undertime($id); 
		
		$this->session->set_flashdata('msg', 'Undertime / Tardy Cancelled!');
		
		redirect(base_url().'leave_manage/undertime/'.$employee_id, 'refresh');
	}
	
	// --------------------------------------------------------------------
	
	function disapproved_leave($leave_apps_id = '')
	{
		//echo $leave_apps_id;
		//exit;
		/*
		$leave_apps = $Leave_Apps->get_leave_apps_info($_GET['leave_apps_id']);
	
		$_GET['employee_id'] 	= $leave_apps['employee_id'];
		$_GET['multiple']	 	= $leave_apps['details'];
		$_GET['month']	 		= $leave_apps['month'];
		$_GET['year']	 		= $leave_apps['year'];
		$_GET['leave_type_id']	= $leave_apps['leave_type_id'];
		$_GET['special_priv_id']= $leave_apps['special_priv_id'];
		$_GET['days']	 		= $leave_apps['days'];
		$_GET['mone']	 		= $leave_apps['details'];
		$_GET['process']	 	= 1;
		
		//set the leave to approved
		$Leave_Apps->set_approved($_GET['leave_apps_id']);
		*/
		redirect(base_url().'leave_manage/leave_apps', 'refresh');
		
	}
	
	// --------------------------------------------------------------------
	
	function leave_card($id)
	{
		$data['msg'] = '';
		
		$this->Employee->fields = array(
										'id',
										'first_day_of_service',
										'lname',
										'fname',
										'mname',
										'office_id',
										'salary_grade',
										'step'
										
										);
		
		$data['name'] = $this->Employee->get_employee_info($id);
		
		$data['cards'] = $this->Leave_card->get_card($id);
		
		$this->load->view('leave_card', $data);
	}
	
	// --------------------------------------------------------------------
	
	function perform_leave_earnings($month, $year, $leave_earn = '')
	{
		$this->Leave_card->process_leave_earnings($month, $year, $leave_earn);
		
		$this->session->set_flashdata('msg', '<b><font color= red>Done leave earnings!</font></b>');
		
		redirect(base_url().'home/home_page', 'refresh');

	}
	
	// --------------------------------------------------------------------
	
	function records()
	{
		
		$data['page_name'] = '<b>Leave Credits</b>';
		$data['msg'] = '';
		
		$office_id = $this->session->userdata('office_id');
		
		//Use for office listbox
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= $this->session->userdata('office_id');
		
		//If office id is selected
		if ($this->input->post('office_id') != 0)
		{
			$office_id = $this->input->post('office_id'); 
			
			$data['selected'] = $office_id;
		}
		
		$this->Employee->fields = array(
										'employee_id',
										'id', 
										'office_id', 
										'lname', 
										'fname', 
										'mname', 
										'salary_grade',
										'step'
										);
			 
		$data['rows'] = $this->Employee->get_permanent($office_id);
		
		if( $this->input->post('op') == 1 && $this->input->post('employee_id') != "")
		{	 
			 $rows = array();
			  
			 $data['rows'] = $this->Employee->get_employee_list($office_id = '', 
															   $this->input->post('employee_id'),
															   $per_page = "", 
															   $off_set = "", 
															   '', 
															   ''
															   );
			 
		}
		
		if ( ($this->input->post('lname'))  && $this->input->post('lname') != "")
		{
			
			$data['rows'] = $this->Employee->get_employee_list($office_id = '', 
															   $employee_id = '', 
															   $per_page = "", 
															   $off_set = "", 
															   $this->input->post('lname'), 
															   ''
															   );
		}
				
		$data['main_content'] = 'records';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function file_leave($employee_id = '')
	{
		
		$data['page_name'] = '<b>File Leave</b>';
		$data['msg'] = '';
		
		//Months
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		$data['leave_type_options'] = $this->options->leave_type_options();
		$data['leave_type_selected']= '';
		
		$data['hospital_view_leave_days'] = $this->Settings->get_selected_field('hospital_view_leave_days');
		
		//echo $hospital_view_leave_days;
		
		$data['employee_id']		= $employee_id;
				
		$data['main_content'] = 'file_leave';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function leave_apps()
	{
		
		$data['page_name'] = '<b>Leave Applications</b>';
		$data['msg'] = '';
		
		$this->load->library('pagination');
		
		$data['rows'] = $this->Leave_apps->get_leave_apps();
		
		// If leave manager get only the leave apps for his/ her office
		if ($this->session->userdata('user_type') == 5)
		{
			$this->Leave_apps->office_id = $this->session->userdata('office_id');
			$this->Leave_apps->get_leave_apps();
		}
		
		$config['base_url'] = base_url().'leave_manage/leave_apps';
		$config['total_rows'] = $this->Leave_apps->num_rows;
	    $config['per_page'] = '15';
	    $config['full_tag_open'] = '<p>';
	    $config['full_tag_close'] = '</p>';
		
		$this->pagination->initialize($config);
		
		// If leave manager get only the leave apps for his/ her office
		if ($this->session->userdata('user_type') == 5)
		{
			$this->Leave_apps->office_id = $this->session->userdata('office_id');
		}
		
		$data['rows'] = $this->Leave_apps->get_leave_apps($config['per_page'], $this->uri->segment(3));

		if ($this->input->post('op') == 1)
		{
			$data['rows'] = $this->Leave_apps->search_leave_apps($this->input->post('tracking_no'));
		}
				
		$data['main_content'] = 'leave_apps';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function forwarded()
	{
		
		$data['page_name'] = '<b>Leave Forwarded</b>';
		$data['msg'] = '';
		
		$data['error_msg'] = '';
		
		//Use for office listbox
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= $this->session->userdata('office_id');
		
		//Months
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
		
		//days
		$data['days_options'] 		= $this->options->days_options();
		$data['days_selected'] 		= date('d');
		
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		if($this->input->post('op'))
		{
			$is_employee_id_exists = $this->Employee->is_employee_id_exists($this->input->post('employee_id'));
		
			if($is_employee_id_exists == FALSE)
			{
				$data['error_msg'] = 'Invalid Employee No.';
			}
			
			$date_cutoff = $this->input->post('year2').'-'.
						   $this->input->post('month2').'-'.
						   $this->input->post('day2');
			
			$forwarded_note = 'Bal. forwarded as of '.
							$this->input->post('month2').'-'.
							$this->input->post('day2').'-'.
							$this->input->post('year2');
			
			$data['msg'] = $this->Forwarded_leave->add_forwarded_leave( $this->input->post('employee_id'), 
																 		$this->input->post('vacation'), 
																 		$this->input->post('sick'),
																 		$forwarded_note,
																		$date_cutoff
																		);
			
			// Remove balance forwarded
			$this->Leave_card->delete_balance_forwarded($this->input->post('employee_id'));
			
			// Delete all entry less than the date forwarded
			$this->Leave_card->delete_less_forwarded($this->input->post('employee_id'), $date_cutoff);
					
			// Put to leave card			
			$info = array(
						"employee_id"	=> $this->input->post('employee_id'),
						"particulars"	=> $forwarded_note,
						"v_balance" 	=> $this->input->post('vacation'),
						"s_balance" 	=> $this->input->post('sick'),
						"date"			=> $this->input->post('year2').'-'.
										   $this->input->post('month2').'-'.
										   $this->input->post('day2')
						);
						
			$this->Leave_card->add_leave_card($info);				
		}	
				
		$data['main_content'] = 'forwarded';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function wop()
	{
		
		$data['page_name'] = '<b>Leave WOP</b>';
		$data['msg'] = '';
		
		//Use for office listbox
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= $this->session->userdata('office_id');
		
		$this->Employee->fields = array('id', 'office_id');
		
		$ids = $this->Employee->get_employee_list();
		
		$wop = array();
		
		$i = 0 ;
		
		foreach ($ids as $id)
		{
			$balance = $this->Leave_card->get_total_leave_credits($id['id']);
			
			
			if ($balance['vacation'] < 0 || $balance['sick'] < 0)
			{
				$wop[$i]['id'] 			= $id['id'];
				$wop[$i]['office_id'] 	= $id['office_id'];
				$wop[$i]['vacation'] 	= $balance['vacation'];
				$wop[$i]['sick'] 		= $balance['sick'];
			}
			
			$i ++;
			
		}
		
		$data['rows'] = $wop;
				
		$data['main_content'] = 'wop';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function stop_earning($employee_id = '')
	{
		
		$data['page_name'] = '<b>Stop Leave earnings</b>';
		$data['msg'] = '';
		
		$data['employee_id'] = $employee_id;
		
		if ($this->input->post('employee_id') != '')
		{
			$data['employee_id'] = $this->input->post('employee_id');
		}
		
		if($this->input->post('op'))
		{
			$this->form_validation->set_rules('employee_id', 'Employee ID', 'required');
			$this->form_validation->set_rules('stop_date', 'Stop of earnings', 'required');
			
			if ($this->form_validation->run($this) == FALSE)
			{
				
			}
			else
			{
				$stop_date = $this->input->post('stop_date');
			
				// Get number of days from first day of the month up to
				// stop date
				list($year, $month, $day) 	= explode('-', $stop_date);
				
				// Get equivalent of days to leave credits
				$days_equivalent = $this->Conversion_table->days_equivalent($day);
				
				// Delete any earnings from first day of the 
				// month up to stop date
				$this->Leave_card->delete_earning($this->input->post('employee_id'), $year.'-'.$month.'-1', $stop_date);
				
				// Insert the last earnings
				$info = array(
							'employee_id'	=> $this->input->post('employee_id'),
							'period'		=> $stop_date,
							'v_earned'		=> $days_equivalent,
							's_earned'		=> $days_equivalent,
							'date'			=> $stop_date,
							'enabled'		=> 1
							);
							
				$this->Leave_card->add_leave_card($info);
				
				// Disable the employee
				
				$this->Employee->fields = array('employee_id');
				$employee_id = $this->Employee->get_employee_info($this->input->post('employee_id'));
				$this->Employee->update_employee(array('status' => 0), $employee_id['employee_id']);
				
				$data['msg'] = 'Done!';
				
			}
			
			
				
		}	
				
		$data['main_content'] = 'stop_earning';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function settings($employee_id = '')
	{
		
		$data['page_name'] = '<b>Settings</b>';
		$data['msg'] = '';
		
		$data['leave_certification_template'] = $this->Settings->get_selected_field('leave_certification_template');
		
				
		if($this->input->post('op'))
		{
			
			$this->Settings->update_settings('leave_certification_template', $this->input->post('leave_certification_template'));	
			
			$data['leave_certification_template'] = $this->Settings->get_selected_field('leave_certification_template');	
		}	
				
		$data['main_content'] = 'settings';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Encode Tary/Undertime
	 *
	 * @since 	Version 1.75
	 * @param 	mixed $employee_id
	 * @return 	void
	 */
	function undertime($employee_id = '')
	{
		
		$data['page_name'] = '<b>Encode Tardy/Undertime</b>';
		$data['msg'] = '';
		
		// Months
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		$data['employee_id'] = $employee_id;
		
		if ($this->input->post('employee_id') != '')
		{
			$data['employee_id'] = $this->input->post('employee_id');
		}
		
		$days 		= 0;
		
		$hours 		= 0;
		
		$minutes 	= 0;
						
		if($this->input->post('op'))
		{
			$data['month_selected'] 	= $this->input->post('month');
		
			$data['year_selected'] 		= $this->input->post('year');
			
			//$this->form_validation->set_rules('id', 'Employee ID', 'required|callback_employee_id_check');
			$this->form_validation->set_rules('employee_id', 'Employee ID', 'required|callback_employee_check');
			//$this->form_validation->set_rules('stop_date', 'Stop of earnings', 'required');
			
			if ($this->form_validation->run($this) == FALSE)
			{
				
			}
			else
			{
				
				if ($this->input->post('days') != 0)
				{			
					$days = $this->input->post('days') * 8 * 60 * 60;
				}
				
				if ($this->input->post('hours') != 0)
				{
					$hours = $this->input->post('hours') * 60 * 60;
				}
				
				if ($this->input->post('minutes') != 0)
				{
					$minutes = $this->input->post('minutes') * 60;
				}
				
				
				$total = $days + $hours + $minutes;
				
				$card_month = $this->Helps->get_month_name($this->input->post('month'));
				
				$action_take = substr($card_month, 0, 3).'. '.$this->input->post('year').' Undertime / Tardy'; 
						
				$particulars = 'UT-'.$this->input->post('days').'-'.$this->input->post('hours').'-'.$this->input->post('minutes');		
				
				$last_day = $this->Helps->get_last_day($this->input->post('month'), $this->input->post('year'));
		
				$last_day = $this->input->post('year').'-'.$this->input->post('month').'-'.$last_day;
						
				$vl = $this->Conversion_table->compute_hour_minute($total);
								
				// Insert the last earnings
				$info = array(
							'employee_id'	=> $this->input->post('employee_id'),
							'particulars'	=> $particulars,
							'v_abs'			=> $vl,
							'action_take'	=> $action_take,
							'date'			=> $last_day,
							'enabled'		=> 1
							);
							
				$this->Leave_card->add_leave_card($info);
								
				$data['msg'] = 'Tardy / Undertime has been saved!';
				
			}
			
			
				
		}	
				
		$data['main_content'] = 'encode_undertime';
		
		$this->load->view('includes/template', $data);
		
	}
	
	/**
	 * Check if emmployee id exists
	 *
	 * @param string $employee_id
	 * @return boolean
	 */
	function employee_check($employee_id)
	{
		$is_employee_id_exists = $this->Employee->is_employee_id_exists($employee_id);
		
		if ($is_employee_id_exists == TRUE)
		{
			return TRUE;
			
		}
		else
		{
			
			$this->form_validation->set_message('employee_check', 'Employee ID does not exists!');
			return FALSE;
		}
	}
	
}	

/* End of file leave_manage.php */
/* Location: ./system/application/modules/leave_manage/controllers/leave_manage.php */