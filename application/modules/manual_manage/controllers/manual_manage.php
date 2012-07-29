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
 * @copyright	Copyright (c) 2008 - 2012, Charliesoft
 * @license		http://charliesoft.net/hrmis/user_guide/license.html
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
class Manual_Manage extends MX_Controller {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		//$this->output->enable_profiler(TRUE);
    }  
	
	// --------------------------------------------------------------------
	
	function cancel_office_pass($id)
	{
		// Delete from leave card first
		$info = $this->Office_pass->get_pass_info( $id );
		
		$this->Leave_card->delete_pass_slip($info['employee_id'], $info['date']);
		
		//echo $info['employee_id'];
		//echo $info['date'];
		
		//print_r($info);
		//exit;
		
		$this->Office_pass->cancel_office_pass($id);
		
		
		$data['msg'] =  'Office Pass set!';
		
		$this->session->set_flashdata('msg', 'Office Pass/ Pass slip cancelled!');
		
		redirect(base_url().'manual_manage/office_pass', 'refresh');
	}
	
	// --------------------------------------------------------------------
	
	function cancel_cto($id = '', $employee_id = '')
	{
		$c = new Compensatory_timeoff();
		$c->get_by_id($id);
		$c->delete();
		
		$this->Dtr->cancel_cto($id, $employee_id);
		
		$this->session->set_flashdata('msg', 'Compensatory Timeoff has been cancelled!');
		
		redirect(base_url().'manual_manage/cto/'.$employee_id, 'refresh');
	}
	
	// --------------------------------------------------------------------
	
	function ob()
	{
		$data['page_name'] = '<b>Official Business</b>';
		
		$data['msg'] = '';
		
		//Months
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
		
		//Days
		$data['days_options'] 		= $this->options->days_options();
		$data['days_selected'] 		= date('d');
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		
		if($this->input->post('op') == 1)
		{
			
			$log_type = 'Official Business';
			
			$manual_log_type = 1;	
			
			$employee_id = $this->input->post('employee_id');
				
			$is_employee_id_exists = $this->Employee->is_employee_id_exists($employee_id);
			
			
			if($is_employee_id_exists == FALSE)
			{
				$data['msg']='<strong><font color=red>Invalid Employee ID</font></strong>';
			}
			else
			{
				$name = $this->Employee->get_employee_info($employee_id);
				
				$office_id		= $name['office_id'];
				
				$month 		= $this->input->post('month');
				$day 		= $this->input->post('day');
				$year 		= $this->input->post('year');
				$month2 	= $this->input->post('month2');
				$day2 		= $this->input->post('day2');
				$year2 		= $this->input->post('year2');
				
				$month3 	= $this->input->post('month3');
				$day3 		= $this->input->post('day3');
				$year3 		= $this->input->post('year3');
				
				$hour 		= $this->input->post('hour');
				$minute 	= $this->input->post('minute');
				$am_or_pm 	= $this->input->post('am_or_pm');
				
				$notes 		= $this->input->post('notes');
				
				$date 		= $year.'-'.$month.'-'.$day;
				$date2 		= $year2.'-'.$month2.'-'.$day2;
				
				//If the user check the this date only checkbox
				if($this->input->post('this_date_only'))
				{
					$date2 = $date;
				}
				
				//If the half day is selected = ========================================================
				if($this->input->post('month3'))
				{	
					$half_date = $year3.'-'.$month3.'-'.$day3;
					
					$is_log_date_exists = $this->Dtr->is_log_date_exists($employee_id, $half_date);
					
					if($am_or_pm == 'AM')
					{
						$field = 'am_login';
						$field2 = 'am_logout';
					}
					
					if($am_or_pm=='PM')
					{
						$field = 'pm_login';
						$field2 = 'pm_logout';
					}
					
					//Update
					if( $is_log_date_exists == TRUE)
					{
						$info  = array($field => $log_type, $field2 => $log_type);
						
						$this->Dtr->edit_dtr($info, $employee_id, $half_date);
						
						//Use for user logs
						$this->Logs->insert_logs(
												$this->session->userdata('username'), 
												$this->session->userdata('office_id'), 
												'Official Business EVENT', 
												'', 
												$employee_id
												);
												
						//Use for messaging
						$this->session->set_flashdata('msg', 'Official Business set! ('.$name['fname'].' '.$name['mname'].' '.$name['lname'].' '.$half_date.')');
						
						//Redirect to adding new employee form
						redirect(base_url().'manual_manage/ob', 'refresh');								
						
						
					}
					else //insert
					{
						
						//Insert to manual log
						$info = array(
									"employee_id" 			=> $employee_id, 
									"office_id"				=> $office_id,
									"cover_if_ob_or_leave" 	=> $half_date,
									"cover_if_ob_or_leave2" => 'Half Day',
									"log_type" 				=> $manual_log_type,
									"notes" 				=> $notes
									);
									
						//Get the ID of inserted values
						$half_id = $this->Manual_log->insert_manual_log($info); 
						
						$info = array(
									$field 			=> $log_type, 
									$field2 		=> $log_type,
									"log_date" 		=> $half_date,
									"employee_id" 	=> $employee_id,
									"office_id" 	=> $office_id,
									'manual_log_id' => $half_id
									);
						
						
						$this->Dtr->insert_dtr($info); 
						
						//Use for user logs
						$this->Logs->insert_logs(
												$this->session->userdata('username'), 
												$this->session->userdata('office_id'), 
												$log_type.' EVENT', 
												'', 
												$employee_id
												);
												
						//Use for messaging
						$this->session->set_flashdata('msg', 'Official Business set! ('.$name['fname'].' '.$name['mname'].' '.$name['lname'].' '.$half_date.')');
						
						//Redirect to adding new employee form
						redirect(base_url().'manual_manage/ob', 'refresh');			
					}
				}
			
				else//If the half day is not selected (Whole day)
				{
				
					//if the date1 is greater that date2
					//output the message (cannot create the OB or Leave. the second date is greater than the first date)
					if($date>$date2)
					{
						$data['msg'] = 'Cannot create the OB or Leave. the second date is greater than the first date.';
					
					}	
					else
					{
					
						//Insert the data to manual log for easy retrieval of manual logs
						
						$info = array(
									"employee_id" 			=> $employee_id, 
									"office_id" 			=> $office_id,
									"cover_if_ob_or_leave" 	=> $date,
									"cover_if_ob_or_leave2" => $date2,
									"log_type" 				=> $manual_log_type,
									"notes" 				=> $notes
									);
						//get the ID of inserted values
						$manual_log_id = $this->Manual_log->insert_manual_log($info);
						
						
						//$no_record = $_POST['action'].' set! ('.$name['first'].' '.$name['middle'].' '.$name['last'].' '.$date.' to '.$date2.')';
					
						//first argument smaller, 2nd argument bigger
						$dates 	= $this->Helps->days_between($date, $date2);
			
						$d1 	= explode("-", $date);
						$year3 	= $d1[0];
						$month3 = $d1[1];
						$day3 	= $d1[2];
					
						//count number of days leave
						$count_number_of_leave = 0;
					
						for( $i = $dates; $i >= 0; $i-- )
						{
							$the_date = date("Y-m-d",mktime(0, 0, 0, $month3  , $day3+$i, $year3));
						
							//To determine if the day is saturday or sunday
							$sat_or_sun = date("l", mktime(0, 0, 0, $month  , $day+$i, $year));
						
							
							//Get the data from holiday
							$date_is_holiday = date("Y-m-d",mktime(0, 0, 0, $month3  , $day3+$i, $year3));
							
							$holiday = $this->Holiday->is_holiday($date_is_holiday);
							
							//If the day is saturday or sunday, dont insert the data to dtr table
							if($sat_or_sun=='Saturday' || $sat_or_sun=='Sunday' || $holiday==TRUE)
							{
						
							}
							else //If the day is not saturday nor sunday
							{
						
								//count number of days leave
								$count_number_of_leave += 1;
									 
								$is_log_date_exists = $this->Dtr->is_log_date_exists($employee_id, $the_date);
								
								//Delete the data if the date and employee id exists
								if($is_log_date_exists == TRUE)
								{
									//delete the data
									$this->Dtr->delete_dtr($employee_id, $the_date);
							
									//Turn $is_log_date_exists to FALSE
									$is_log_date_exists = FALSE;
								}
								
								//If no result found
								if($is_log_date_exists == FALSE)
								{
									//i will decide what data will be pass to dtr table. Is it OB or leave or the time itself
									//insert the data to dtr if the type of leave is not
									//commutation or monetization
									
									$info = array(
												"employee_id" 	=> $employee_id, 
												"log_date" 		=> $the_date,
												"manual_log_id" => $manual_log_id,
												"am_login" 		=> $log_type,
												"am_logout" 	=> $log_type,
												"pm_login" 		=> $log_type,
												"pm_logout" 	=> $log_type,
												"office_id" 	=> $office_id
												);
									
									$this->Dtr->insert_dtr($info); 
								}
							}	
							
							//Use for user logs
							$this->Logs->insert_logs(
												$this->session->userdata('username'), 
												$this->session->userdata('office_id'), 
												$log_type.' EVENT', 
												'', 
												$employee_id
												);
												
							//Use for messaging
							$this->session->set_flashdata('msg', 'Official Business set! ('.$name['fname'].' '.$name['mname'].' '.$name['lname'].' '.$the_date.')');
							
							//Redirect to adding new employee form
							redirect(base_url().'manual_manage/ob', 'refresh');						
						}
								
					
					}	
					
				}
			}
		
		}	
				
		$data['main_content'] = 'ob';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function login()
	{
		
		$data['page_name'] = '<b>Manual Login/Logout</b>';
		
		$data['msg'] = '';
	
		$data['options'] 					= $this->options->office_options();
		$data['selected'] 					= $this->session->userdata('office_id');
	
		//Months
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
		
		//Days
		$data['days_options'] 		= $this->options->days_options();
		$data['days_selected'] 		= date('d');
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
				
		$data['main_content'] = 'login';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function cto( $employee_id = '' )
	{
		$data['page_name'] = '<b>Compensatory Time Off</b>';
		$data['msg'] = '';
		
		//Months
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		$data['leave_type_options'] = $this->options->leave_type_options();
		$data['leave_type_selected']= '';
		
		$data['employee_id']		= $employee_id;
				
		$data['main_content'] = 'cto';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function cto_apps()
	{
		
		
		$data['page_name'] = '<b>CTO Applications</b>';
		$data['msg'] = '';
		
		$this->load->library('pagination');
		
		$data['rows'] = $this->Compensatory_timeoff->get_cto_apps();
		
		// If leave manager get only the leave apps for his/ her office
		if ($this->session->userdata('user_type') == 5)
		{
			$this->Compensatory_timeoff->office_id = $this->session->userdata('office_id');
			$this->Compensatory_timeoff->get_cto_apps();
		}
		
		$config['base_url'] = base_url().'manual_manage/cto_apps';
		$config['total_rows'] = $this->Compensatory_timeoff->num_rows;
	    $config['per_page'] = '15';
	    $this->config->load('pagination', TRUE);
		
		$pagination = $this->config->item('pagination');
		
		// We will merge the config file of pagination
		$config = array_merge($config, $pagination);
		
		$this->pagination->initialize($config);
		
		// If leave manager get only the leave apps for his/ her office
		if ($this->session->userdata('user_type') == 5)
		{
			$this->Compensatory_timeoff->office_id = $this->session->userdata('office_id');
		}
		
		$data['rows'] = $this->Compensatory_timeoff->get_cto_apps($config['per_page'], $this->uri->segment(3));

		if ($this->input->post('op') == 1)
		{
			$data['rows'] = $this->Compensatory_timeoff->search_cto_apps($this->input->post('tracking_no'));
			
			if ( $this->input->post('tracking_no') == '' )
			{
				$data['rows'] = $this->Compensatory_timeoff->get_cto_apps($config['per_page'], $this->uri->segment(3));
			}
			
			if ( $this->input->post('tracking_no') != '')
			{
				$config['total_rows'] = 0;
				$this->pagination->initialize($config);
			}
			
		}
				
		$data['main_content'] = 'cto_apps';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function cto_forward_balance( $office_id = '' )
	{
		$data['page_name'] = '<b>CTO Forward Balance</b>';
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
			
			$data['msg'] = $this->Leave_forwarded->add_forwarded_leave( $this->input->post('employee_id'), 
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
				
		$data['main_content'] = 'cto_forward_balance';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function office_pass()
	{
		
		$data['page_name'] = '<b>Office Pass</b>';
		$data['msg'] = '';
		
		//Months
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
		
		//
		$data['days_options'] 		= $this->options->days_options();
		//$data['days_selected'] 		= 1;//date('d');
		
		//
		$data['days_options'] 		= $this->options->days_options();
		$data['days_selected'] 		= date('d');
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		if ($this->input->post('op'))
		{
			
			$seconds = strtotime($this->input->post('hour2').':'.$this->input->post('minute2'). ' '.$this->input->post('am_pm2')) - 
					   strtotime($this->input->post('hour').':'.$this->input->post('minute'). ' '.$this->input->post('am_pm'));
			
			if ($this->input->post('am_pm') == 'AM' && $this->input->post('am_pm2') == 'PM')
			{
				$seconds = strtotime('12:00 PM') - strtotime($this->input->post('hour').':'.$this->input->post('minute'). ' '.$this->input->post('am_pm'));
				
				$seconds += strtotime($this->input->post('hour2').':'.$this->input->post('minute2'). ' '.$this->input->post('am_pm2')) - strtotime("01:00 PM");
			}
			
			$info = array(
						'employee_id' 	=> $this->input->post('employee_id'),
						'date'		 	=> $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day'),
						'time_out'	  	=> $this->input->post('hour').':'.$this->input->post('minute'). ' '.$this->input->post('am_pm'),
						'time_in'	 	=> $this->input->post('hour2').':'.$this->input->post('minute2'). ' '.$this->input->post('am_pm2'),
						'seconds'	  	=> $seconds,
						'date_acquired'	=> date('Y-m-d')
			);
			
			$this->Office_pass->insert_office_pass($info);
			
			// Insert to leave card but not yet active
			
			$card_month = $this->Helps->get_month_name($this->input->post('month'));
			
			$particulars = 'Pass Slip';
			
			$last_day = $this->Helps->get_last_day($this->input->post('month'), $this->input->post('year'));
		
			$last_day = $this->input->post('year').'-'.$this->input->post('month').'-'.$last_day;
			
			$v_abs = $this->Leave_conversion_table->compute_hour_minute($seconds);
			
			$action_take = substr($card_month, 0, 3).'. '.$this->input->post('year').' Pass Slip'; 
			
			$pass_slip_date = $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day');
			
			$this->Leave_card->insert_entry(
											$this->input->post('employee_id'), 
											$particulars, 
											$v_abs, 
											$action_take, 
											$last_day, 
											0, 
											$pass_slip_date
											);
			
			
			$data['msg'] =  'Office Pass/ Pass slip set!';
			
			$this->session->set_flashdata('msg', 'Office Pass/ Pass slip set!');
		}
		
		
		$data['main_content'] = 'office_pass';
		
		$this->load->view('includes/template', $data);
		
	}
}	

/* End of file manual_manage.php */
/* Location: ./system/application/modules/manual_manage/controllers/manual_manage.php */