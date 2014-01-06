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
 * iHRMIS Leave Manage Class
 *
 * This class use for leave management. Filing of leave, certifications and more...
 *
 * @package		iHRMIS
 * @subpackage	Models
 * @category	Models
 * @author		Manny Isles
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis/hrmis/user_guide/controllers/leave_manage.html
 */
class Leave_Manage extends MX_Controller {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		//$this->output->enable_profiler(TRUE);
    }  
	
	// --------------------------------------------------------------------
	
	function cancel_leave($id, $employee_id, $csc = '', $cpo = '')
	{
		$csc = ($csc == 0) ? '' : $csc;
		$cpo = ($cpo == 0) ? '' : $cpo;
		
		$this->Dtr->cancel_leave($id, $employee_id, $csc, $cpo);
		
		Session::flash('msg', 'Leave has been cancelled!');
		
		$this->Logs->insert_logs(
									'leave', 
									'CANCEL LEAVE', 
									'Cancel Leave', 
									$employee_id
									);
		
		return Redirect::to('leave_manage/file_leave/'.$employee_id, 'refresh');
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
		
		Session::flash('msg', 'Undertime / Tardy Cancelled!');
		
		return Redirect::to('leave_manage/undertime/'.$employee_id, 'refresh');
	}
	
	// --------------------------------------------------------------------
	
	function leave_card($id, $print_from = '', $print_to = '')
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
		
		// Modified 02.28.2012
		// Since version 2.00.00
		// We'll check the leave earning from
		// First day of service to the latest
		// encoded data. We do this for Province of Laguna
		
		$month2 = $this->Leave_card->get_last_leave_filed($id);
		
		$present_date = date('Y-m-d');
		
		// If there is leave filed and the the last date
		// of filing of leave is less than the current date			
		if ($month2 != NULL and ($month2 < $present_date))
		{
			$month2 = date('Y-m-d');
		}
		
		if ($month2 == NULL)
		{
			$month2 = $data['name']['first_day_of_service'];
			
		}
		
		$months = $this->Helps->get_months($data['name']['first_day_of_service'], $month2);
		
		// Check if there is a balance forwarded for the employee	
		$is_forwarded_leave_exists = $this->Leave_forwarded->is_forwarded_leave_exists($id);
		
		// If there is a forwarded balance
		if ($is_forwarded_leave_exists == TRUE)
		{	
			// Get forwarded leave
			$row_leave 			= $this->Leave_forwarded->get_forwarded_leave($id);
						
			$forward_as_of = substr($row_leave['forwarded_note'], -10);
			
			list($a_month, $a_day, $a_year) = explode('-', $forward_as_of);
						
			$months = $this->Helps->get_months($a_year.'-'.$a_month.'-'.$a_day, $month2);			
			
		}		
		
		// We get here the last day of the month
		// for every month fromn 1st day of service to date
		foreach($months as $month)
		{
			list($y, $m) = explode('-', $month);
			
			$all_date[] = date('Y-m-d',mktime(0, 0, 0, ($m + 1), 0, $y));
			
		}
		
		// Sort the array of dates
		sort($all_date);
		
		// Remove duplicate values
		$dates = array_unique($all_date);
		
		$lgu_code = Setting::getField( 'lgu_code' );
		
		if ($lgu_code == 'laguna_province')
		{
			$i = 0;
			
			foreach ($dates as $date)
			{
				// Lets earned the leave credits if not exists(first month from 1st day of service)
				if ($i == 0)
				{
					// This month is the first month of the service
					// We'll check if the employee has earn his/her
					// first leave credits
					
					list($year3, $month3, $day3) = explode('-', $data['name']['first_day_of_service']);
					
					// If there is a forwarded balance
					if ($is_forwarded_leave_exists == TRUE)
					{	
						$year3 	= $a_year;
						$month3 = $a_month;
						$day3 	= $a_day;
					}	
					
					list($year4, $month4, $day4) = explode('-', $date);
					
					$days_earned = $day4 - $day3;
					
					$days_earned += 1; // add 1 day because we include the 1st day of service
										//  in our count
															
					// Lets check if how many days has the current month and year
					$cal_days_in_month = cal_days_in_month(CAL_GREGORIAN, $month4, $year4);
					
					// We will remove one day since we only need 30 days per month.
					// Thanks to LANI of HRMO Laguna.
					if ($cal_days_in_month == 31)
					{
						$days_earned = $days_earned - 1;// 
					}
										
					if ($days_earned >= 31)
					{
						$days_earned = 30;
					}					
					
					
					// We'll get the equivalent
					$first_month_earned = $this->Leave_conversion_table->days_equivalent($days_earned);
					
					// Add to leave card table
					$data1 = array(
								"employee_id"	=> $id,
								"period" 		=> $date,
								"v_earned" 		=> $first_month_earned, 
								"s_earned" 		=> $first_month_earned,
								"date"			=> $date
								);
					
					// Lets check if the leave earning exist 
					// before we insert another one.
					
					$is_leave_earn_exists = $this->Leave_card->is_leave_earn_exists($data1);
					
					if ($is_leave_earn_exists == FALSE)
					{
						$this->Leave_card->add_leave_card($data1);
					}
					else
					{
						// Lets update the existing record
						$lc = new Leave_card_m();
						$lc->where('employee_id', $id);
						$lc->where('period', $date);
						$lc->where('date', $date);
						$lc->get();
												
						$lc->employee_id	= $id;
						$lc->period			= $date;
						$lc->v_earned 		= $first_month_earned; 
						$lc->s_earned 		= $first_month_earned;
						$lc->date			= $date;
						$lc->save();
												
					}
					
					$i ++;
					
					
					
				}
				else
				{
					// Add to leave card table
					$data1 = array(
								"employee_id"	=> $id,
								"period" 		=> $date,
								"v_earned" 		=> 1.25, 
								"s_earned" 		=> 1.25,
								"date"			=> $date
								);
					
					// Lets check if the leave earning exist 
					// before we insert another one.
					
					$is_leave_earn_exists = $this->Leave_card->is_leave_earn_exists($data1);
					
					$allow_earned = FALSE;
					
					$present_date = date('Y-m-d');
					
					// If the present date is greater than the date
					// that the leave should earned
					// Ex: if today is 2012.03.02 then the date of earned is 2012.02.29
					
					if ($present_date > $date)
					{
						$allow_earned = TRUE;
					}
					
					if ($is_leave_earn_exists == FALSE and $allow_earned == TRUE)
					{
						$this->Leave_card->add_leave_card($data1);
					}
					
					
				}
				
			}
		}
		// End modification	
	
		// Additional features (autodeduct forced leave) 3.27.2012
		$auto_deduct_forced_leave = Setting::getField( 'auto_deduct_forced_leave' );
		
		if ($auto_deduct_forced_leave == 'yes')
		{
		
			// Lets get all the years from first day of service to date
			$first_year = $year3;
			
			$present_year = date('Y');
			
			while ($present_year >= $first_year)
			{
				// Years to process
				$years_process[] = $present_year;
							
				$present_year --;
			}
			
			sort($years_process);
			
			foreach ($years_process as $year_process)
			{
				// The forced leave law only started on 1986
				// So we should process the year if the year
				// is greater than or equal to 1986
				if ($year_process >= 1986)
				{
					
					// We will get how many VL and FL an employee consume
					// for the particular year which the FL is not system
					// generated.
					$lc = new Leave_card_m();
					$lc->select_sum('v_abs');
					$lc->where('YEAR(date)', $year_process);
					$lc->where("(leave_type_id ='7' OR leave_type_id ='1')"); // added forced leave
					$lc->where('forced_leave_system_generated','no');
					$lc->where('employee_id', $id);
					$lc->get();
										
					// We need to check if the leave earned for the 
					// particular year is 10 or more

					$tvl = new Leave_card_m();
					$total_vacation_leave = $tvl->total_vacation_leave($id, $year_process);
					
					
					// If employee consume less than 5 VL
					// and $total_vacation_leave is more than 10
					// We will automatically insert the forced leave
					if ( $lc->v_abs < 5 and $total_vacation_leave > 10)
					{
						$total_vl_spent = $lc->v_abs - 5;
						
						$total_vl_spent = abs($total_vl_spent); // We will get the abs value
																// since the result will become
																// negative
									
						// We need to check if the last day of the year
						// for this '$year_process'
						// is less than the current date.
						// Meaning if today is 3.27.2012 we will not insert
						// the forced leave for year 2012
						
						if ($year_process.'-12-31' < date('Y-m-d'))
						{
							// Lets check if the system generated forced leave exists
							$fl = new Leave_card_m();
							$fl->where('date', $year_process.'-12-31');
							$fl->where('leave_type_id', 7);
							$fl->where('employee_id',$id);
							$fl->where('forced_leave_system_generated','yes');
							$fl->get();
							
							// Save
							$fl->employee_id					= $id;
							$fl->particulars					= $total_vl_spent.' Forced Leave';
							$fl->v_abs 							= $total_vl_spent;
							$fl->action_take 					= 'December 31, '.$year_process;
							$fl->date							= $year_process.'-12-31';
							$fl->leave_type_id 					= 7;
							$fl->forced_leave_system_generated	= 'yes';
							$fl->save();
								
							//echo $this->db->last_query().'<br>';
										
						}// end if ($year_process.'-12-31' < date('Y-m-d'))
						
						
					}// end if ( $lc->v_abs < 5 and $total_vacation_leave > 10)
					

				}// end if ($year_process >= 1986)

			}// end foreach ($years_process as $year_process)
			
		}// end if ($auto_deduct_forced_leave == 'yes')
		// end additional features
		


		
		$data['cards'] = $this->Leave_card->get_card($id);
		
		return View::make('leave_card', $data);
	}
	
	// --------------------------------------------------------------------
	
	function perform_leave_earnings($month, $year, $leave_earn = '')
	{
		$this->Leave_card->process_leave_earnings($month, $year, $leave_earn);
		
		Session::flash('msg', '<b><font color= red>Done leave earnings!</font></b>');
		
		return Redirect::to('home/home_page', 'refresh');

	}
	
	// --------------------------------------------------------------------
	
	function records()
	{
		
		$data['page_name'] = '<b>Leave Credits</b>';
		$data['msg'] = '';
		
		$office_id = Session::get('office_id');
		
		//Use for office listbox
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= Session::get('office_id');
		
		// If office id is selected
		if (Input::get('office_id') != 0)
		{
			$office_id = Input::get('office_id'); 
			
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
				
		if( Input::get('op') == 1 && Input::get('employee_id') != "")
		{	 
			 $rows = array();
			  
			 $data['rows'] = $this->Employee->get_employee_list($office_id = '', 
															   Input::get('employee_id'),
															   $per_page = "", 
															   $off_set = "", 
															   '', 
															   ''
															   );
			 
		}
		
		if ( (Input::get('lname'))  && Input::get('lname') != "")
		{
			
			$data['rows'] = $this->Employee->get_employee_list($office_id = '', 
															   $employee_id = '', 
															   $per_page = "", 
															   $off_set = "", 
															   Input::get('lname'), 
															   ''
															   );
		}
				
		$data['main_content'] = 'records';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function file_leave($employee_id = '')
	{
		
		$data['page_name'] = '<b>File Leave</b>';
		$data['msg'] = '';
		
		// Months
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		$data['leave_type_options'] = $this->options->leave_type_options();
		$data['leave_type_selected']= '';
		
		$data['hospital_view_leave_days'] = Setting::getField('hospital_view_leave_days');
				
		$data['employee_id']		= $employee_id;
				
		$data['main_content'] = 'file_leave';
		
		$this->load->library('leave/leave');
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function add_earning($employee_id = '')
	{
		
		$data['page_name'] = '<b>Add Earning</b>';
		$data['msg'] = '';
		
		//Months
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		$data['leave_type_options'] = $this->options->leave_type_options();
		$data['leave_type_selected']= '';
		
		$data['employee_id']		= $employee_id;
				
		$data['main_content'] = 'add_earning';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function leave_apps()
	{
		
		$data['page_name'] = '<b>Leave Applications</b>';
		$data['msg'] = '';
		
		$this->load->library('pagination');
		
		$data['rows'] = $this->Leave_apps->get_leave_apps();
		
		// If leave manager get only the leave apps for his/ her office
		if (Session::get('user_type') == 5)
		{
			$this->Leave_apps->office_id = Session::get('office_id');
			$this->Leave_apps->get_leave_apps();
		}
		
		$config['base_url'] = base_url().'leave_manage/leave_apps';
		$config['total_rows'] = $this->Leave_apps->num_rows;
	    $config['per_page'] = '15';
	  	$this->config->load('pagination', TRUE);
		
		$pagination = $this->config->item('pagination');
		
		// We will merge the config file of pagination
		$config = array_merge($config, $pagination);
		
		$this->pagination->initialize($config);
		
		// If leave manager get only the leave apps for his/ her office
		if (Session::get('user_type') == 5)
		{
			$this->Leave_apps->office_id = Session::get('office_id');
		}
		
		$data['rows'] = $this->Leave_apps->get_leave_apps($config['per_page'], $this->uri->segment(3));
		
		if (Input::get('op') == 1 and Input::get('tracking_no') != '')
		{
			$data['rows'] = $this->Leave_apps->search_leave_apps(Input::get('tracking_no'));
		}
				
		$data['main_content'] = 'leave_apps';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function forwarded()
	{
		
		$data['page_name'] = '<b>Leave Forwarded</b>';
		$data['msg'] = '';
		
		$data['error_msg'] = '';
		
		//Use for office listbox
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= Session::get('office_id');
		
		//Months
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
		
		//days
		$data['days_options'] 		= $this->options->days_options();
		$data['days_selected'] 		= date('d');
		
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		if(Input::get('op'))
		{
			$is_employee_id_exists = $this->Employee->is_employee_id_exists(Input::get('employee_id'));
		
			if($is_employee_id_exists == FALSE)
			{
				$data['error_msg'] = 'Invalid Employee No.';
			}
			
			$date_cutoff = Input::get('year2').'-'.
						   Input::get('month2').'-'.
						   Input::get('day2');
			
			$forwarded_note = 'Bal. forwarded as of '.
							Input::get('month2').'-'.
							Input::get('day2').'-'.
							Input::get('year2');
			
			$data['msg'] = $this->Leave_forwarded->add_forwarded_leave( Input::get('employee_id'), 
																 		Input::get('vacation'), 
																 		Input::get('sick'),
																 		$forwarded_note,
																		$date_cutoff
																		);
			
			// Remove balance forwarded
			$this->Leave_card->delete_balance_forwarded(Input::get('employee_id'));
			
			// Delete all entry less than the date forwarded
			$this->Leave_card->delete_less_forwarded(Input::get('employee_id'), $date_cutoff);
					
			// Put to leave card			
			$info = array(
						"employee_id"	=> Input::get('employee_id'),
						"particulars"	=> $forwarded_note,
						"v_balance" 	=> Input::get('vacation'),
						"s_balance" 	=> Input::get('sick'),
						"date"			=> Input::get('year2').'-'.
										   Input::get('month2').'-'.
										   Input::get('day2')
						);
						
			$this->Leave_card->add_leave_card($info);				
		}	
				
		$data['main_content'] = 'forwarded';
		
		return View::make('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function wop()
	{
		
		$data['page_name'] = '<b>Leave WOP</b>';
		$data['msg'] = '';
		
		//Use for office listbox
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= Session::get('office_id');
		
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
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function stop_earning($employee_id = '')
	{
		
		$data['page_name'] = '<b>Stop Leave earnings</b>';
		$data['msg'] = '';
		
		$data['employee_id'] = $employee_id;
		
		if (Input::get('employee_id') != '')
		{
			$data['employee_id'] = Input::get('employee_id');
		}
		
		if(Input::get('op'))
		{
			$this->form_validation->set_rules('employee_id', 'Employee ID', 'required');
			$this->form_validation->set_rules('stop_date', 'Stop of earnings', 'required');
			
			if ($this->form_validation->run($this) == TRUE)
			{
				$stop_date = Input::get('stop_date');
			
				// Get number of days from first day of the month up to
				// stop date
				list($year, $month, $day) 	= explode('-', $stop_date);
				
				// Get equivalent of days to leave credits
				$days_equivalent = $this->Leave_conversion_table->days_equivalent($day);
				
				// Delete any earnings from first day of the 
				// month up to stop date
				$this->Leave_card->delete_earning(Input::get('employee_id'), $year.'-'.$month.'-1', $stop_date);
				
				// Insert the last earnings
				$info = array(
							'employee_id'	=> Input::get('employee_id'),
							'period'		=> $stop_date,
							'v_earned'		=> $days_equivalent,
							's_earned'		=> $days_equivalent,
							'date'			=> $stop_date,
							'enabled'		=> 1
							);
							
				$this->Leave_card->add_leave_card($info);
				
				// Disable the employee
				
				$this->Employee->fields = array('employee_id');
				$employee_id = $this->Employee->get_employee_info(Input::get('employee_id'));
				$this->Employee->update_employee(array('status' => 0), $employee_id['employee_id']);
				
				$data['msg'] = 'Done!';
				
			}
			
			
				
		}	
				
		$data['main_content'] = 'stop_earning';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function settings($employee_id = '')
	{
		
		$data['page_name'] = '<b>Settings</b>';
		$data['msg'] = '';
		
		$data['leave_certification_template'] = Setting::getField('leave_certification_template');
		
		$data['leave_certification_template'] = '';
				
		if(Input::get('op'))
		{
			
			$this->Settings->update_settings('leave_certification_template', Input::get('leave_certification_template'));	
			
			$data['leave_certification_template'] = Setting::getField('leave_certification_template');	
		}	
				
		$data['main_content'] = 'settings';
		
		return View::make('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Encode Tary/Undertime
	 *
	 * @since 	Version 1.75
	 * @param 	mixed $employee_id
	 * @return 	void
	 */
	function undertime($employee_id = '', $pop_up = '')
	{
		
		$data['page_name'] = '<b>Encode Tardy/Undertime</b>';
		$data['msg'] = '';
		
		// Months
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		$data['employee_id'] = $employee_id;
		
		if (Input::get('employee_id') != '')
		{
			$data['employee_id'] = Input::get('employee_id');
		}
		
		$days 		= 0;
		
		$hours 		= 0;
		
		$minutes 	= 0;
						
		if(Input::get('op'))
		{
			$data['month_selected'] 	= Input::get('month');
		
			$data['year_selected'] 		= Input::get('year');
			
			$this->form_validation->set_rules('employee_id', 'Employee ID', 'required|callback_employee_check');
			
			if ($this->form_validation->run($this) == TRUE)
			{
				
				if (Input::get('days') != 0)
				{			
					$days = Input::get('days') * 8 * 60 * 60;
				}
				
				if (Input::get('hours') != 0)
				{
					$hours = Input::get('hours') * 60 * 60;
				}
				
				if (Input::get('minutes') != 0)
				{
					$minutes = Input::get('minutes') * 60;
				}
				
				
				$total = $days + $hours + $minutes;
				
				$card_month = $this->Helps->get_month_name(Input::get('month'));
				
				$action_take = substr($card_month, 0, 3).'. '.Input::get('year').' Undertime / Tardy'; 
						
				$particulars = 'UT-'.Input::get('days').'-'.Input::get('hours').'-'.Input::get('minutes');		
				
				$last_day = $this->Helps->get_last_day(Input::get('month'), Input::get('year'));
		
				$last_day = Input::get('year').'-'.Input::get('month').'-'.$last_day;
						
				$vl = $this->Leave_conversion_table->compute_hour_minute($total);
				
				// If the user encode the v_abs in textbox
				// use the value of textbox
				if (Input::get('v_abs'))
				{
					$vl = Input::get('v_abs');
					
					$particulars = 'UT-';
				}
				
				// modified 7.7.2012 4.39pm
				 $enable_add_day_encode_tardy = Setting::getField('enable_add_day_encode_tardy');
	  
				 if ($enable_add_day_encode_tardy == 'yes')
				 {
					  $last_day = Input::get('year').'-'.Input::get('month').'-'.Input::get('day');
				 }
				
								
				// Insert the last earnings
				$info = array(
							'employee_id'	=> Input::get('employee_id'),
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
				
		if ($pop_up == 1)
		{
			return View::make('encode_undertime', $data);
		}
		else
		{
			$data['main_content'] = 'encode_undertime';
		
			return View::make('includes/template', $data);
		}
				
		
		
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