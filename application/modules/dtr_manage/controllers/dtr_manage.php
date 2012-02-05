<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dtr_Manage extends MX_Controller {

	// --------------------------------------------------------------------
	
	var $array_pdf 				= array();
	
	var $employee_array			= array();
	
	var $employee_id			= '';
	
	var $month					= '';
	
	var $year					= '';
	
	var $period_from			= '';
	
	var $period_to				= '';
	
	var $dont_compute_dates		= '';
	
	var $sat_or_sun				= '';
	
	var $is_holiday				= FALSE;
	
	var $late_final 			= 0;	// Late counter (minutes or hours late)
	
	var $late_count 			= 0;	// Late count (number of lates
	
	var $undertime_final 		= 0;	// Undertime
	
	var $undertime_count 		= 0;	// Undertime count (number of undertime)
	
	var $total_tardiness		= 0;
	
	var $line_number 			= 1;	// Where the writing in pdf should.
	
	var $number_of_days 		= 0;	// Number of days work

	var $final_over_time 		= 0;	// Number of overtime
	
	var $overtime 				= 0;	// Overtime
	
	var $number_of_hours_work 	= 0;	// Number of hours worked
	
	var $shift_type				= 1;
	
	var $am_login				= '';
	
	var $am_logout				= '';
	
	var $pm_login				= '';
	
	var $pm_logout				= '';
	
	var $ot_login				= '';
	
	var $ot_logout				= '';
	
	var $leave_type_id			= '';
	
	var $log_date				= ''; 
	
	var $manual_log_id			= '';
	
	var $time_a					= '08:00';
	var $time_b					= '12:00';
	var $time_c					= '13:00';
	var $time_d					= '17:00';	
	
	var $allow_40hrs			= FALSE;	// Allow 40 hrs per week
	
	var $week1_hours			= 0;		// Day 1 - 8
	var $week2_hours			= 0;		// Day 9 - 15
	var $week3_hours			= 0;		// Day 16 - 22
	var $week4_hours			= 0;		// Day 23 - 31
	
	var $week1_days				= array('01', '02', '03', '04', '05', '06', '07');
	var $week2_days				= array('08', '09', '10', '11', '12', '13', '14', '15');
	var $week3_days				= array('16', '17', '18', '19', '20', '21', '22');
	var $week4_days				= array('23', '24', '25', '26', '27', '28', '28', '30', '31');
	
	var $week1_total_tardiness	= 0;		// Total of hours tardy
	var $week2_total_tardiness	= 0;
	var $week3_total_tardiness	= 0;
	var $week4_total_tardiness	= 0;
	
	var $week1_late_count		= 0;		// Total of late count
	var $week2_late_count		= 0;
	var $week3_late_count		= 0;
	var $week4_late_count		= 0;
	
	var $week1_late_final		= 0;		// Total of weekly late
	var $week2_late_final		= 0;		
	var $week3_late_final		= 0;		
	var $week4_late_final		= 0;		
	
	var $week1_undertime_count	= 0;		// Total of undertime count
	var $week2_undertime_count	= 0;
	var $week3_undertime_count	= 0;
	var $week4_undertime_count	= 0;
	
	var $week1_undertime_final	= 0;		// Total of weekly undertime
	var $week2_undertime_final	= 0;		
	var $week3_undertime_final	= 0;		
	var $week4_undertime_final	= 0;		
	

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		//$this->output->enable_profiler(TRUE);
		
		//http://codeigniter.com/user_guide/libraries/loader.html
		//$this->load->add_package_path('c:/xampp/htdocs/system_common/foo_bar');
		//$this->load->library('sample');
		
		//$this->sample->tae();
		

    }  
	
	// --------------------------------------------------------------------
		
	function dtr()
	{
		$data['page_name'] = '<b>View/Print DTR</b>';
		$data['msg'] = '';
		
		$data['pop_up'] = 0;
		
		// Use for office listbox
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= $this->session->userdata('office_id');
		
		// Type of employment
		$data['permanent_options'] 	= $this->options->type_employment($all = TRUE);
		$data['permanent_selected'] = '';
		
		// Months
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
		
		// Period from
		$data['days_options'] 		= $this->options->days_options();
		//$data['days_selected'] 		= 1;//date('d');
		
		// Period to
		$data['days_options'] 		= $this->options->days_options();
		$data['days_selected'] 		= date('d');
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		$op = $this->input->post('op');
		
		//If ($op == 1) ================== START ==========================
		if ($op == 1)
		{
			
			$data['month_selected'] 	= $this->input->post('month');
		
			$data['days_selected'] 		= $this->input->post('period_to');
		
			$data['year_selected'] 		= $this->input->post('year');
			
			// Get the data that need to process
	
			$this->employee_array[] = $this->input->post('employee_id');
			
			$this->employee_array[] = $this->input->post('hidden_employee_id');
			
			
			// Dont compute dates 
			$this->dont_compute_dates = $this->Settings->get_selected_field('dont_compute');
			
			$this->month		= $this->input->post('month');
			$this->year			= $this->input->post('year');
			$this->period_from 	= $this->input->post('period_from');
			$this->period_to   	= $this->input->post('period_to');
			
			// If the Multiple employee checkbox is checked
			if($this->input->post('multi_employee'))
			{
				// Array of employee from checkboxes
				$employees	 = $this->input->post('employee');
				
				if(is_array($employees))
				{
					$this->employee_array = $employees;
				}
				
			}
			
			// If the request is from view attendance page===>>>>
			$this->from_view_attendance();
			
			
			
			// Remove empty array
			$this->employee_array = array_filter($this->employee_array);
			//print_r($this->employee_array);
			//exit;
			// Foreach($employee_array as $employee_id) ========= START =============
			foreach($this->employee_array as $employee_id)
			{
				
				$this->employee_id = $employee_id;
				
				$between_from = $this->year.'-'.$this->month.'-'.$this->period_from;
				$between_to   = $this->year.'-'.$this->month.'-'.$this->period_to;
				
				// Dates to be delete after insert to table
				$array_of_deleted_dates = $this->Dtr->get_blank_dates($this->employee_id, 
																	  $this->period_from, 
																	  $this->period_to, 
																	  $this->year, 
																	  $this->month
																	  );
				
				// Get employee info
				$this->Employee->fields = array(
											'fname',
											'mname', 
											'lname', 
											'shift_type', 
											'office_id',
											'detailed_office_id',
											'assistant_dept_head',
											);//Fields
				
				//echo $this->employee_id;
				//exit;
				
				$name = $this->Employee->get_employee_info($this->employee_id);
				
				// Check what type of user is logged
				// If leave manager
				$this->load->library('session');
				
				if ( $this->session->userdata('user_type') == 5)
				{
					// If the office is not equal to office id of user logged
					if ($this->session->userdata('office_id') != $name['office_id'])
					{
						echo '<font color="red">You are not allowed to view this records!</font>';
						exit;
					}
					
				}
				
				$whole_name = $name['fname'].' '.$name['mname'].' '.$name['lname'];
			
				$this->shift_type = $name['shift_type'];
				
				$this->load->library('fpdf');
		
				//define('FPDF_FONTPATH', $this->config->item('fonts_path'));
							
				$this->load->library('fpdi');
				
				// initiate FPDI   
				$pdf = new FPDI();
				// add a page
				$pdf->AddPage();
				// set the sourcefile
				$pdf->setSourceFile('dtr/template/dtr.pdf');
				
				// select the first page
				$tplIdx = $pdf->importPage(1);
				
				// use the page we imported
				$pdf->useTemplate($tplIdx);
				
				// set font, font style, font size.
				$pdf->SetFont('Times','B',11);
				
				####################################
				#THIS IS FOR THE NAME OF EMPLOYEE  #
				####################################
				
				// set initial placement
				$pdf->SetXY(30, 22.5);
				
				// line break
				$pdf->Ln(5);
				
				// go to 25 X (indent)
				$pdf->SetX(40);
				
				// write
				$pdf->Write(0, ucwords(strtolower(utf8_decode($whole_name))));
				
				
				// go to 25 X (indent)
				$pdf->SetX(130);
				
				// write
				$pdf->Write(0, ucwords(strtolower(utf8_decode($whole_name))));
			
				########################################
				#THIS IS FOR THE NAME OF EMPLOYEE (END)#
				########################################
				
				
				####################################
				#THIS IS FOR THE MONTH             #
				####################################
				
				$month2 = $this->Helps->get_month_name($this->month);
			
				// line break
				$pdf->Ln(11);
				
				// go to 25 X (indent)
				$pdf->SetX(43);
				
				// write
				$pdf->Write(0, ucwords(strtolower($month2.', '.$this->year)));
				
				
				// go to 25 X (indent)
				$pdf->SetX(137);
				
				// write
				$pdf->Write(0, ucwords(strtolower($month2.', '.$this->year)));
			
				####################################
				#THIS IS FOR THE MONTH (END)       #
				####################################
			
			
				$pdf->Ln(28.5);
				$pdf->SetFont('Times','',9);
			
			
				// This will start the writing process to pdf
				
				// DTR query result
				
				$this->Dtr->fields = array(
										'am_login',
										'am_logout',
										'pm_login',
										'pm_logout',
										'ot_login',
										'ot_logout',
										'leave_type_id',
										'log_date',
										'manual_log_id'
										);
				
				$dtr_result = $this->Dtr->employee_dtr($between_from, $between_to, $this->employee_id);
				
				//foreach ($dtr_result as $row) ========= START ====================================
				foreach ($dtr_result as $row)
				{
					
					$this->am_login 		= $row['am_login'];
					$this->am_logout		= $row['am_logout'];
					$this->pm_login 		= $row['pm_login'];
					$this->pm_logout		= $row['pm_logout'];
					$this->ot_login 		= $row['ot_login'];
					$this->ot_logout		= $row['ot_logout'];
					$this->leave_type_id 	= $row['leave_type_id'];
					$this->log_date 		= $row['log_date'];
					$this->manual_log_id 	= $row['manual_log_id'];
						
					// Split the logged_date
					// As of PHP 5.3.0 the regex extension is deprecated, 
					// calling this function will issue an E_DEPRECATED notice.
					list($log_year, $log_month, $log_day) = explode('-', $this->log_date);
					
					// Check if the day is Sat or Sun
					$this->sat_or_sun = $this->Helps->is_sat_sun($log_month, $log_day, $log_year);
					
					// Check if the day is holiday
					$this->is_holiday = $this->Holiday->is_holiday($this->log_date);
					
					$allow_forty_hours = $this->Settings->get_selected_field('allow_forty_hours');
					
					
					
					if ( $this->log_date == '2011-08-20')
					{
						//echo $this->am_login.' '.$this->am_logout.' '.$this->pm_login.' '.$this->pm_logout;
						//exit;
					}
					// If regular hours (8-5)
					// We can also use shift_type 3 here because it has
					// 4 logs
					//if( $this->shift_type == 1 )
					if( $this->shift_type == 1 || $this->shift_type == 3)
					{
						$this->regular_hours();
						
						$this->allow_40hrs == FALSE;
					}
					
					// If shifting
					if ($this->shift_type == 2)
					{
						if ( $allow_forty_hours == 1)
						{
							// Allow 40 hrs per week
							$this->allow_40hrs = TRUE;
						}
						
						
						$this->shifting_same_day();
					}
					
					// If 24 hrs
					//if ($this->shift_type == 3)
					if ($this->shift_type == 4)
					{
						if ( $allow_forty_hours == 1)
						{
							// Allow 40 hrs per week
							$this->allow_40hrs = TRUE;
						}
						
						$this->shifting_same_day();// added 7.27.2011 5:47pm
					}
					//echo $this->log_date.' -- '.$this->Helps->hours_late.'<br>';
					//===========RESET Late and undertime
					$this->Helps->hours_late		= 0;
					$this->Helps->count_late		= 0;
					
					$this->Helps->hours_undertime	= 0;
					$this->Helps->count_undertime	= 0;
					
					$this->Helps->am_login 			= 0;
					$this->Helps->pm_login 			= 0;
					
					$this->Helps->am_logout 		= 0;
					$this->Helps->pm_logout 		= 0;
					
					$this->Helps->pm_late_hours 	= 0;
					$this->Helps->pm_undertime_hours= 0;
					
					
					//Set the line number from where in the pdf position will be place
					
					if($this->line_number==4  || $this->line_number==6  || $this->line_number==8  || 
					   $this->line_number==11 || $this->line_number==14 || $this->line_number==17 || 
					   $this->line_number==19 || $this->line_number==21 || $this->line_number==24 || 
					   $this->line_number==28)
					{
						$line_number_view = 4;
						//this is for the use of $pdf->Ln(16) function
						//example $pdf->Ln($line_number)
					}
					else
					{
						$line_number_view = 3.5;
					}
			
			
					$pdf->Ln($line_number_view);
					
					// Check for saturdays and sundays
					
					// If the date has log on it
					if ($this->am_login 	!= "" 	or $this->am_logout != "" or $this->pm_login 	!= "" or 
						$this->pm_logout 	!= "" 	or $this->ot_login 	!= "" or $this->ot_logout 	!= "")
					{
						//Do nothing
					}
					
					// Put data to DTR
					else
					{
						// Do if not Leave
						//if ( $this->leave_type_id != 0 )
						//{
							if ($this->sat_or_sun == 'Saturday')
							{
								$this->am_login = 'SATURDAY';
							}
							
							if ($this->sat_or_sun == 'Sunday')
							{
								$this->am_login = 'SUNDAY';
							}
							
							// If the date is holiday
							if ($this->is_holiday == TRUE)
							{
								$this->am_login = strtoupper($this->Holiday->holiday_name($this->log_date));
							}
						//}
						
						
					}
					
					
					// Check if Official Business (Change Official Business to OB)
					$this->am_login 	= $this->Helps->is_ob($this->am_login);
					$this->am_logout 	= $this->Helps->is_ob($this->am_logout);
					$this->pm_login 	= $this->Helps->is_ob($this->pm_login);
					$this->pm_logout 	= $this->Helps->is_ob($this->pm_logout);
					
					// If whole day ob
					if ($this->am_login == 'OB' && $this->am_logout == 'OB' && 
						$this->pm_login == 'OB' && $this->pm_logout == 'OB')
					{
						$notes = $this->Manual_log->get_notes($this->manual_log_id);
						
						if (trim($notes) == '')
						{
							$this->am_login 	= 'OB';
							$this->am_logout 	= 'OB';
							$this->pm_login 	= 'OB';
							$this->pm_logout 	= 'OB';
						}
						else
						{
							$this->am_login = 'Official Business  --';
							$this->am_logout 	= '';
							$this->pm_login 	= $notes;
							$this->pm_logout 	= '';
						}
						
						
					}
					
					
					
					// Check if the log is leave		
					if ($this->leave_type_id != 0 && $this->am_login == 'Leave' && $this->am_logout == 'Leave' && 
						$this->pm_login == 'Leave' && $this->pm_logout == 'Leave')
					{
						$this->am_login = strtoupper ($this->Leave_type->get_leave_name($this->leave_type_id));
						$this->am_logout= '';
						$this->pm_login = '';
						$this->pm_logout= '';
					}
					
					// If half day leave (morning)
					if ($this->leave_type_id != 0 && $this->am_login == 'Leave' && $this->am_logout == 'Leave')
					{
						$this->am_login = strtoupper ($this->Leave_type->get_leave_code($this->leave_type_id));
						$this->am_logout= '';
						//echo 'yes';
						//exit;
					}
					
					$pm_is_leave = FALSE;
					// If half day leave (afternoon)
					if ($this->leave_type_id != 0 && $this->pm_login == 'Leave' && $this->pm_logout == 'Leave')
					{
						$this->pm_login = strtoupper ($this->Leave_type->get_leave_code($this->leave_type_id));
						$this->pm_logout= '';
						
						$pm_is_leave = TRUE;
					}
					
					
					// Execute only if regular hours (8-5)
					// and special sched (added 08-08-2011)
					if ($this->shift_type == 1 || $this->shift_type == 3)
					{
				
						// We need to check if the settings enabled for this halfday tardy
						// Check if there is no log on am or pm
						// For the compliant to CSC MC 17 series of 2010
						// put VL if absent on AM and VL if absent on PM
						
						// AM Absent
						if ($this->am_login == '' && $this->am_logout == '' && $this->pm_login != '' && $this->pm_logout != '')
						{
							$this->am_login = 'Vacation Leave';
							$this->am_login = 'Late';
							$this->am_login = 'Tardy';
							$this->am_logout= '';
							
							// Change font color
							$this->Helps->font_color_am_login = 200;
						}
						
						// PM Absent
						if ($this->am_login != '' && $this->am_logout != '' && $this->pm_login == '' && $this->pm_logout == '')
						{
							$this->pm_login = 'Vacation Leave';
							$this->pm_login = 'Undertime';
							$this->pm_logout= '';
							
							// Check if saturday or sunday and shift_id == 1
							// if true we dont need to put undertime to DTR
							if ( $this->shift_type == 1 && ($this->sat_or_sun == 'Saturday' || $this->sat_or_sun == 'Sunday'))
							{
								$this->pm_login = '';
							}
							
							// Change font color
							$this->Helps->font_color_pm_login = 200;
							
						}
						// PM Absent(no log out)
						else if($this->am_login != '' && $this->am_logout != '' && $this->pm_login != '' && $this->pm_logout == '')
						{
							$this->pm_logout= 'Undertime';
							
							// If pm is leave
							if ($pm_is_leave == TRUE)
							{
								$this->pm_logout = '';
							}
							
							// Change font color
							$this->Helps->font_color_pm_logout = 200;
						}
						
						// PM Absent(no log in)
						else if($this->am_login != '' && $this->am_logout != '' && $this->pm_login == '' && $this->pm_logout != '')
						{
							//$this->pm_logout= 'Undertime';
							$this->pm_login= 'UT';
							
							// If pm is leave
							if ($pm_is_leave == TRUE)
							{
								//$this->pm_logout = '';
							}
							
							// Change font color
							$this->Helps->font_color_pm_login = 200;
						}
						
						
						// AM Absent(no log out)
						else if($this->am_login != '' && $this->am_logout == '' && $this->pm_login != '' && $this->pm_logout != '')
						{
							$this->am_logout= 'Tardy';
							
							// If pm is leave
							if ($pm_is_leave == TRUE)
							{
								//$this->pm_logout = '';
							}
							
							// Change font color
							$this->Helps->font_color_am_logout = 200;
						}
						
						
						
					
					}
					
					
					
					//convert the time to 12 hour 
					
					//am login A
					$pdf->SetX(24);
					$pdf->SetTextColor($this->Helps->font_color_am_login, 0, 0);
					$pdf->SetFont('Times', $this->Helps->am_font_bold, 9);
					$pdf->Write(0, $this->am_login);
					
					
					//am login B
					$pdf->SetX(118);
					$pdf->Write(0, $this->am_login);
					$this->Helps->font_color_am_login = 0;
					$this->Helps->am_font_bold = '';
					
					//am logout A
					$pdf->SetX(36);
					$pdf->SetTextColor($this->Helps->font_color_am_logout, 0, 0);
					$pdf->SetFont('Times', $this->Helps->am_out_bold, 9);
					$pdf->Write(0, $this->am_logout);
					
					//am logout B
					$pdf->SetX(130);
					$pdf->Write(0, $this->am_logout);
					$this->Helps->font_color_am_logout = 0;
					$this->Helps->am_out_bold = '';
				
					//pm login A
					$pdf->SetX(50);
					$pdf->SetTextColor($this->Helps->font_color_pm_login, 0, 0);
					$pdf->SetFont('Times', $this->Helps->pm_font_bold, 9);
					
					// Change format(only if notes is blank)
					if(isset($notes) && $notes != '')
					{
						$this->pm_login = $notes;
					}
					else
					{
						// If pm login is not leave and pm login is not half day absent(vacation leave)
						// If( ($this->leave_type_id == 0 && $this->pm_login != 'Vacation Leave') ) orig
						if( ($this->leave_type_id == 0 && $this->pm_login != 'Undertime' && $this->pm_login != 'UT') )
						{
							$this->pm_login = $this->Helps->change_format($this->pm_login, 1, $format = '');
						}
						
						// If leave in the pm and pm_login is not equal to leave code(VL, SPL)
						if( $this->leave_type_id != 0 && $this->pm_login != strtoupper ($this->Leave_type->get_leave_code($this->leave_type_id)) )
						{
							$this->pm_login = $this->Helps->change_format($this->pm_login, 1, $format = '');
						}
						
					}
					
					// Reset the notes to blank
					$notes = '';
					
					$pdf->Write(0, $this->pm_login);
					
					//pm login B
					$pdf->SetX(144);
					$pdf->Write(0, $this->pm_login);
					$this->Helps->font_color_pm_login = 0;
					$this->Helps->pm_font_bold = '';
				
					//pm logout A
					$pdf->SetX(62);
					$pdf->SetTextColor($this->Helps->font_color_pm_logout, 0, 0);
					$pdf->SetFont('Times', $this->Helps->pm_out_bold, 9);
					
					//Change format
					if( ($this->leave_type_id == 0 && $this->pm_logout != 'Undertime') )
					{
						$this->pm_logout = $this->Helps->change_format($this->pm_logout, 1, $format = '');
					}
					$pdf->Write(0, $this->pm_logout);
					
					//pm logout B
					$pdf->SetX(157);
					$pdf->Write(0, $this->pm_logout);
					$this->Helps->font_color_pm_logout = 0;
					$this->Helps->pm_out_bold = '';
				
					//ot login A
					$pdf->SetX(74);
					$pdf->SetTextColor(0, 0, 0);
					$this->ot_login = $this->Helps->change_format($this->ot_login, 1, $format = '');
					$pdf->Write(0, $this->ot_login);
					
					//ot login B
					$pdf->SetX(169);
					$pdf->SetTextColor(0, 0, 0);
					$pdf->Write(0, $this->ot_login);
				
					//ot logout A
					$pdf->SetX(88);
					$pdf->SetTextColor(0, 0, 0);
					$this->ot_logout = $this->Helps->change_format($this->ot_logout, 1, $format = '');
					$pdf->Write(0, $this->ot_logout);
					
					//ot logout B
					$pdf->SetX(182);
					$pdf->SetTextColor(0, 0, 0);
					$pdf->Write(0, $this->ot_logout);
					
					$this->line_number++ ;
					
					//echo $this->log_date.' '.$this->late_final.'<br>';
					//exit;
					
								
				}//foreach ($dtr_result as $row) ========= END ====================================
				
				//exit;
				// If allow the 40 hrs per week (offsettings)=====================================
				if ($this->allow_40hrs == TRUE)
				{
					// If the work for 1st week is 40 hours or more or 5 days or more
					if ($this->Helps->compute_time($this->week1_hours) >= '5 days')
					{
						
						// Subtract the week 1 total late and undertime count
						$this->late_count 		-= $this->week1_late_count;
						$this->undertime_count	-= $this->week1_undertime_count;
						
						// Subtract the week 1 total late and undertime hours
						$this->late_final 		-= $this->week1_late_final;
						$this->undertime_final	-= $this->week1_undertime_final;
					}
					
					// If the work for 2nd week is 40 hours or more or 5 days or more
					if ($this->Helps->compute_time($this->week2_hours) >= '5 days')
					{
						// Subtract the week 2 total late and undertime count
						$this->late_count 		-= $this->week2_late_count;
						$this->undertime_count	-= $this->week2_undertime_count;
						
						// Subtract the week 2 total late and undertime hours
						$this->late_final 		-= $this->week2_late_final;
						$this->undertime_final	-= $this->week2_undertime_final;
					}
					
					// If the work for 3rd week is 40 hours or more or 5 days or more
					if ($this->Helps->compute_time($this->week3_hours) >= '5 days')
					{
						// Subtract the week 3 total late and undertime count
						$this->late_count 		-= $this->week3_late_count;
						$this->undertime_count	-= $this->week3_undertime_count;
						
						// Subtract the week 3 total late and undertime hours
						$this->late_final 		-= $this->week3_late_final;
						$this->undertime_final	-= $this->week3_undertime_final;
					}
					
					// If the work for 4th week is 40 hours or more or 5 days or more
					if ($this->Helps->compute_time($this->week4_hours) >= '5 days')
					{
						// Subtract the week 4 total late and undertime count
						$this->late_count 		-= $this->week4_late_count;
						$this->undertime_count	-= $this->week4_undertime_count;
						
						// Subtract the week 4 total late and undertime hours
						$this->late_final 		-= $this->week4_late_final;
						$this->undertime_final	-= $this->week4_undertime_final;
					}
				}// =================================================================
				
				
				// set initial placement
				$pdf->SetXY(30, 34);
				//$pdf->Ln(160.5);
				$pdf->Ln(153);
				//total A
				$pdf->SetX(50);
				//$pdf->Write(0, ucwords(($this->Helps->compute_time($this->number_of_hours_work))));
				//total B
				$pdf->SetX(145);
				//$pdf->Write(0, ucwords(($this->Helps->compute_time($this->number_of_hours_work))));
				
				// LGU CODE
				$lgu_code = $this->Settings->get_selected_field( 'lgu_code' );
				
				
				if ( $lgu_code == 'marinduque_province' )
				{
					// Total tardiness
					$this->total_tardiness = $this->late_final + $this->undertime_final;
					
					//$this->late_count += $this->undertime_count;
					
					$this->undertime_final = $this->Helps->compute_time($this->undertime_final + $this->late_final);
					
					$this->late_final = '';
					
					
				}
				else
				{
					// Total tardiness
					$this->total_tardiness = $this->late_final + $this->undertime_final;
					
					// Compute the late in words
					$this->late_final = $this->Helps->compute_time($this->late_final);
					
					// Compute undertime
					$this->undertime_final = $this->Helps->compute_time($this->undertime_final);
				}
				
				
				// Total
				$pdf->Ln(48);
				$pdf->SetX(17);
				$pdf->Write(0, 'Tardiness:');
				
				$pdf->SetX(40);
				$pdf->Write(0, '('.$this->late_count.'x)' .$this->late_final);
				
				
				$pdf->SetX(110);
				$pdf->Write(0, 'Tardiness:');
				
				$pdf->SetX(133);
				$pdf->Write(0, '('.$this->late_count.'x)' .$this->late_final);
				
				$pdf->Ln(6);
				
				$pdf->SetX(17);
				$pdf->Write(0, 'Under time:');
				$pdf->SetX(40);
				if ( $lgu_code == 'marinduque_province' )
				{
					$pdf->Write(0, $this->undertime_final);
				}
				else
				{
					$pdf->Write(0, '('.$this->undertime_count.'x) ' .$this->undertime_final);
				}
				
				
				
				$pdf->SetX(110);
				$pdf->Write(0, 'Under time:');
				
				$pdf->SetX(133);
				if ( $lgu_code == 'marinduque_province' )
				{
					$pdf->Write(0, $this->undertime_final);
				}
				else
				{
					$pdf->Write(0, '('.$this->undertime_count.'x) ' .$this->undertime_final);
				}
				
				//overtime
				$pdf->Ln(6);
				$this->number_of_hours_work = $this->Helps->compute_time($this->number_of_hours_work);
				$pdf->SetX(17);
				//$pdf->Write(0, ucwords(('Number of Tardiness:')));
				
				$pdf->SetX(50);
				//$pdf->Write(0, ucwords(($late_count + $undertime_count)));
				
				$pdf->SetX(110);
				//$pdf->Write(0, ucwords(('Number of Tardiness:')));
				
				$pdf->SetX(143);
				//$pdf->Write(0, ucwords(($late_count + $undertime_count)));
				
				
				//overtime
				$this->overtime = $this->Helps->compute_time($this->overtime);
				
				$print_overtime_in_dtr = $this->Settings->get_selected_field( 'print_overtime_in_dtr' );
				
				if ( $print_overtime_in_dtr == 1)
				{
					$pdf->SetX(17);
					$pdf->Write(0, ucwords(('Over time:')));
					$pdf->Write(0, ucwords(($this->overtime)));
					
					
					$pdf->SetX(110);
					$pdf->Write(0, ucwords(('Over time:')));
					$pdf->Write(0, ucwords(($this->overtime)));
				}
				
				// If allow the 40 hrs per week
				if ($this->allow_40hrs == TRUE)
				{
					$pdf->Ln(6);
					$pdf->SetX(17);
					$pdf->Write(0, ('The system allow the 40 hrs a week'));
					
					$pdf->SetX(110);
					$pdf->Write(0, ('The system allow the 40 hrs a week'));
					
					// We require hours only here.
					$this->Helps->hours_only = TRUE;
					
					$pdf->Ln(4);
					$pdf->SetX(17);
					$pdf->Write(0, ('1st week: '.$this->Helps->compute_time($this->week1_hours)));
					
					$pdf->SetX(110);
					$pdf->Write(0, ('1st week: '.$this->Helps->compute_time($this->week1_hours)));
					
					$pdf->Ln(4);
					$pdf->SetX(17);
					$pdf->Write(0, ('2nd week: '.$this->Helps->compute_time($this->week2_hours)));
					
					$pdf->SetX(110);
					$pdf->Write(0, ('2nd week: '.$this->Helps->compute_time($this->week2_hours)));
					
					$pdf->Ln(4);
					$pdf->SetX(17);
					$pdf->Write(0, ('3rd week: '.$this->Helps->compute_time($this->week3_hours)));
					
					$pdf->SetX(110);
					$pdf->Write(0, ('3rd week: '.$this->Helps->compute_time($this->week3_hours)));
					
					$pdf->Ln(4);
					$pdf->SetX(17);
					$pdf->Write(0, ('4th week: '.$this->Helps->compute_time($this->week4_hours)));
					
					$pdf->SetX(110);
					$pdf->Write(0, ('4th week: '.$this->Helps->compute_time($this->week4_hours)));
				}
				
				// Add office head and designation
				$print_office_head_in_dtr = $this->Settings->get_selected_field( 'print_office_head_in_dtr' );
				
				if ( $print_office_head_in_dtr == 1)
				{
					
					$office = $this->Office->get_office_info($name['office_id']);
					
					// If detailed
					if ( $name['detailed_office_id'] != 0 )
					{					
						$detailed_office = $this->Office->get_office_info($name['detailed_office_id']);
						$office['office_head'] = $detailed_office['office_head'];
						$office['position'] = $detailed_office['position'];
					}
					
					// If Employee is Department head
					$o = new Orm_office();
					
					$o->get_by_employee_id($this->employee_id);
					
					if ( $o->exists())
					{
						if ( $lgu_code == 'marinduque_province' )
						{
							$office['office_head'] 	= 'CARMENCITA O. REYES';
							$office['position'] 	= 'Governor';
						}
						else // for puerto princesa
						{
							$office['office_head'] 	= 'ATTORNEY AGUSTIN M. ROCAMORA';
							$office['position'] 	= 'City Administrator';
						}
						
						
					}
					
					// check if assistant
					if ( $lgu_code == '' ) // puerto
					{
						if ( $name['assistant_dept_head'] == 1)
						{
							$office['office_head'] 	= 'ATTORNEY AGUSTIN M. ROCAMORA';
							$office['position'] 	= 'City Administrator';
						}
					}
					
					// We need to work out for this as exception
					if ( $this->employee_id == '61')
					{
						$office['office_head'] 	= 'ANTONIO L. UY, JR. M.D.';
						$office['position'] 	= 'Vice Governor';
					}
					
					// We need to work out for this as exception (Puerto)
					if ( $this->employee_id == '013001')
					{
						$office['office_head'] 	= 'LUCILO BAYRON';
						$office['position'] 	= 'Vice Mayor';
					}
					
					
					$pdf->SetXY(17, 217);
					$pdf->Cell(73, 4, strtoupper($office['office_head']), '0', 0, 'C', FALSE);
					
					$pdf->SetX(110);
					$pdf->Cell(73, 4, strtoupper($office['office_head']), '0', 0, 'C', FALSE);
					
					$pdf->Ln(4);
					
					$pdf->SetX(17);
					$pdf->Cell(73, 4, $office['position'], '0', 0, 'C', FALSE);
					
					$pdf->SetX(110);
					$pdf->Cell(73, 4, $office['position'], '0', 0, 'C', FALSE);
				}
				
				
				
				
				// Process the adding of undertime to leave card
				$this->leave_card_undertime();
				
				// Reset 
				$this->late_count 			= 0;
				$this->late_final 			= 0;
				$this->undertime_count 		= 0;
				$this->undertime_final 		= 0;
				
				$this->line_number			= 1;
				$this->overtime				= 0;
				
				$this->number_of_hours_work = 0;
				
				
				header('Cache-Control: maxage=3600'); //Adjust maxage appropriately
				
				header('Pragma: public');
			
				// If the parameter is D = download F = save as file
				
				$pdf->Output('dtr/archives/'.$name['office_id']."_$employee_id.pdf", 'F'); 
				
				// All name of dtr file. put in an array
				$multiple_dtr[] = 'dtr/archives/'.$name['office_id']."_$employee_id.pdf";
				
				foreach($array_of_deleted_dates as $dates)
				{
					$this->Dtr->delete_dtr($this->employee_id, $dates);
				}
							
				
			}//foreach($employee_array as $employee_id) ========= START ====================================
			
			if(file_exists('dtr/archives/'.$name['office_id'].".pdf"))
			{
				unlink('dtr/archives/'.$name['office_id'].".pdf");
			}
			
			/*
			// Concatenate the pdf files
			$pdf = new FPDI();
			
			$pdf->setFiles($multiple_dtr); 
			$pdf->concat();
			
			$pdf->Output('dtr/archives/'.$name['office_id'].".pdf", 'F'); 
			*/
			
			// Changed on 1.28.2012
			// Since I updated the fpdf and fpdi libraries,
			// I did this for safe update of libraries
			// Orig is on top of this comments
			
			$this->load->library('concat_pdf');
						
			$this->concat_pdf->setFiles($multiple_dtr); 
			$this->concat_pdf->concat();
			
			$this->concat_pdf->Output('dtr/archives/'.$name['office_id'].".pdf", 'F'); 
			
			
			// Delete all files
			foreach($this->array_pdf as $filename)
			{
				if(file_exists($filename))
				{
					unlink($filename);
				}
			}
			
			$data['pop_up'] = 1;
			$data['office_id'] = $name['office_id'];
			
			$_POST['office_id'] = $name['office_id'];// added 2011-02-14
			
			// Delete all tardiness with zero seconds
			$this->Tardiness->delete_zero_seconds();
			
		}//if ($op == 1) ================== END ==========================	
		
		
		//To do: execute if page is not from view attendance
		
		if ($this->input->get('from_view_attendance') != TRUE)
		{			
			$data['main_content'] = 'dtr';
		
			$this->load->view('includes/template', $data);
		}
		
	}
	
	// --------------------------------------------------------------------
	
	function jo()
	{
		$data['page_name'] = '<b>Contractual / Job Order</b>';
		$data['msg'] = '';
		
		$data['month'] = date('m');
		$data['year'] = date('Y');
		
		if(isset($_POST['op']) )
		{
			$data['month'] 	= $_POST['month'];
			$data['year'] 	= $_POST['year'];	
		}

		$data['rows'] = $this->Employee->get_jo_contract();
				
		$data['main_content'] = 'jo';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function double_entries()
	{
		$data['page_name'] = '<b>Double Entries</b>';
		$data['msg'] = '';
		
		// Months
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
				
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		//$this->Dtr->double_entries($month = 04, $year = 2011);
		
		$data['rows'] = $this->Dtr->double_entries(date('m'), date('Y'));
		
		if(isset($_POST['op']) )
		{
			$data['month_selected'] 	= $_POST['month'];
			$data['year_selected'] 		= $_POST['year'];
			$data['rows'] = $this->Dtr->double_entries($_POST['month'], $_POST['year']);	
		}
		
		
				
		$data['main_content'] = 'double_entries';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function from_view_attendance()
	{
		if ($this->input->get('office_id'))
		{
			// Office 1st
			
			$this->Employee->fields = array('employee_id');
			
			$employees = $this->Employee->get_employee_list(
												$this->input->get('office_id')
												);
			
			foreach ($employees as $employee)
			{
				$this->employee_array[] =  $employee['employee_id'];
			}
			
			
			if ($this->input->get('employee_id') && 
			$this->input->get('employee_id') != "" && 
			$this->input->get('employee_id') != "Employee ID")
			{
				$this->employee_array = array($this->input->get('employee_id'));
			}
			
			// Process the dates
			$date 	= $this->input->get('date');
			$date2 	= $this->input->get('date2');
		
			list($this->year, $this->month, $this->period_from) = explode('-', $date);
			list($this->year, $this->month, $this->period_to) 	= explode('-', $date2);
		}
	}
	
	// --------------------------------------------------------------------
	
	function regular_hours()
	{
		/*
		$shift_time = $this->Shift->shift_times($this->shift_type, 1);
		
		$this->time_a = $shift_time['time_a'];
		$this->time_b = $shift_time['time_b'];
		$this->time_c = $shift_time['time_c'];
		$this->time_d = $shift_time['time_d'];
		*/
		
		// If regular working hours
		if ( $this->shift_type == 1 )
		{
			$shift_time = $this->Shift->shift_times($this->shift_type, 1);
		
			$this->time_a = $shift_time['time_a'];
			$this->time_b = $shift_time['time_b'];
			$this->time_c = $shift_time['time_c'];
			$this->time_d = $shift_time['time_d'];
			
			//print_r($shift_time);
			//exit;
		}
		
		
		// If special time get the time from schedule_employees
		if ( $this->shift_type == 3 )
		{
			//$se = new Schedule_employees();
			$se = $this->Schedule_employees->get_schedule($this->employee_id );
			
			//$se = $this->Schedule_employees->get_schedule( $this->employee_id, $this->log_date );
			
			//print_r($se);
			//exit;
			
			$this->time_a = $se['am_in'];
			$this->time_b = $se['am_out'];
			$this->time_c = $se['pm_in'];
			$this->time_d = $se['pm_out'];
		}
			
		$dont_compute = explode(',', $this->dont_compute_dates);
		
		if (in_array($this->log_date, $dont_compute))
		{
			$dont_compute = TRUE;
		}
		else
		{
			$dont_compute = FALSE;
		}
		
		// Added 1.5.2012 for the case of rolando marciano
		$shift_type = $this->shift_type;
		if ( $this->employee_id == '152')
		{
			$shift_type = 1;
		}
		// end marciano
		
		// If the day Name is sat or sun or holiday // Do nothing  (Dont compute Tardiness)
		// Added the " && $this->shift_type == 1" 09-05-2011
		if (($this->sat_or_sun == 'Saturday' || $this->sat_or_sun == 'Sunday' || 
			$this->is_holiday == TRUE || $dont_compute == TRUE ) && $shift_type == 1)
		{
			$this->Tardiness->delete_tardiness($this->employee_id, $this->log_date, 0);
			
			if ($this->sat_or_sun == 'Saturday' || $this->sat_or_sun == 'Sunday' || $this->is_holiday == TRUE)
			{
				// OVERTIME FOR SATURDAY, SUNDAY AND HOLIDAY
				if ($this->am_logout != "")
				{
					$this->overtime += strtotime($this->am_logout) - strtotime($this->am_login);
				}
				
				if ($this->pm_logout != "")
				{
					// If the PM login is between 12:01 to 12:59 then make it 1pm
					// Do this if not leave
					if ($this->pm_login > '12:00' && $this->leave_type_id == 0 )
					{
						$this->pm_login = '13:00';//comment it 09-05-2011 due to leave error if leave is sat or sun
					}
				
					
					$this->overtime += strtotime($this->pm_logout) - strtotime($this->pm_login);
				}
				
				if ($this->ot_logout != "")
				{
					$this->overtime += strtotime($this->ot_logout) - strtotime($this->ot_login);
				}
			}
			
			
			
		}
		
		else
		{
			//*****THIS IS TO CHECK FOR THE LATE********//
			
			$this->Helps->employee_id = $this->employee_id; // added 09-07-2011
				
			//am login and pm login check if late
			$late = $this->Helps->check_late($this->am_login, $this->time_a, $this->pm_login, $this->time_c);
			
			
			
			//echo $this->pm_login;
			//exit;
			//echo $this->time_d;
			
			//If there is no late
			//Check if the date has tardiness
			//that entered during dtr viewing
			//(use if the tardiness has been updated 
			//with the wrong dtr record
			//for ex: there is no out so it will generate 
			//a large amount of tardiness
			$this->Tardiness->delete_tardiness($this->employee_id, $this->log_date, $this->Helps->am_login);
			$this->Tardiness->delete_tardiness($this->employee_id, $this->log_date, $this->Helps->pm_login);
			
			//am logout check if undertime
			$undertime = $this->Helps->check_undertime($this->am_logout, $this->time_b, $this->pm_logout, $this->time_d);
			
			$this->Tardiness->delete_tardiness($this->employee_id, $this->log_date, $this->Helps->am_logout);
			$this->Tardiness->delete_tardiness($this->employee_id, $this->log_date, $this->Helps->pm_logout);
			
			// If there is a late in am_login
			if ($this->Helps->am_login != 0)
			{
				$this->Tardiness->check_tardiness($this->employee_id, $this->log_date, $logType = 1, 
								$numberOfSeconds = $this->Helps->am_login);
			}
			
			// If there is a late in pm_login
			if ($this->Helps->pm_login != 0)
			{
				$this->Tardiness->check_tardiness($this->employee_id, $this->log_date, $logType = 3, 
								$numberOfSeconds = $this->Helps->pm_login);
			}
			
			// We need to check if the settings enabled for this halfday tardy
			// Check if there is no log on am or pm
			// For the compliant to CSC MC 17 series of 2010
			// AM Absent
			$number_seconds = 14400;
			
			//$this->time_c = $se['pm_in'];
			//$this->time_d = $se['pm_out'];
			
			// If the sched is not 8-5
			// Example 7-12;2-5
			// meaning we only get 3 hrs undertime for 2pm-5pm
			if ( $this->time_c != '13:00' && $this->time_d != '17:00')
			{
				$number_seconds = strtotime($this->time_d) - strtotime($this->time_c);
			}
			
			if ($this->am_login == '' && $this->am_logout == '' && $this->pm_login != '' && $this->pm_logout != '')
			{
				
				
				$this->Tardiness->check_tardiness($this->employee_id, $this->log_date, $logType = 1, $number_seconds);
				
				//add to late count
				$this->late_count += 1;
				
				$this->late_final += $number_seconds;
			}
			
			// PM Absent
			if (($this->am_login != '' && $this->am_logout != '' && $this->pm_login == '' && $this->pm_logout == '') or
				($this->am_login != '' && $this->am_logout != '' && $this->pm_login != '' && $this->pm_logout == ''))
			{
				$this->Tardiness->check_tardiness($this->employee_id, $this->log_date, $logType = 3, 0);
				
				
				if ($this->Helps->pm_late_hours != 0)
				{
					$this->Helps->count_late -= 1;
					$this->Helps->hours_late -= $this->Helps->pm_late_hours;
				}
				//if ( $this->log_date == '2011-08-08' )
				//{
					//echo $this->log_date.' -- '.$this->Helps->hours_late.' -- '.$this->Helps->pm_late_hours.'<br>';
					//exit;
				//}
				$this->Tardiness->check_tardiness($this->employee_id, $this->log_date, $logType = 4, $number_seconds);
				
				// Add to undertime count
				$this->undertime_count += 1;
				
				$this->undertime_final += $number_seconds;
				
				
			}
			else if($this->am_login != '' && $this->am_logout != '' && $this->pm_login == '' && $this->pm_logout != '')
			{
				$this->Tardiness->check_tardiness($this->employee_id, $this->log_date, $logType = 4, 0);
				
				if ($this->Helps->pm_undertime_hours != 0)
				{
					$this->Helps->count_undertime -= 1;
					$this->Helps->hours_undertime -= $this->Helps->pm_undertime_hours;
				}
				
				$this->Tardiness->check_tardiness($this->employee_id, $this->log_date, $logType = 4, $number_seconds);
				
				// Add to undertime count
				$this->undertime_count += 1;
				
				$this->undertime_final += $number_seconds;
				
				
			}
			
			else if($this->am_login != '' && $this->am_logout == '' && $this->pm_login != '' && $this->pm_logout != '')
			{
				$this->Tardiness->check_tardiness($this->employee_id, $this->log_date, $logType = 2, 0);
				
				if ($this->Helps->pm_undertime_hours != 0)
				{
					$this->Helps->count_undertime -= 1;
					$this->Helps->hours_undertime -= $this->Helps->pm_undertime_hours;
				}
				
				$this->Tardiness->check_tardiness($this->employee_id, $this->log_date, $logType = 2, $number_seconds);
				
				// Add to late count
				$this->late_count += 1;
				
				$this->late_final += $number_seconds;
				
			}
			
			
				
			// Late count (number of lates)
			$this->late_count += $this->Helps->count_late;
					
			// Late counter (minutes or hours late)
			$this->late_final = $this->late_final + $this->Helps->hours_late;
				
			/*****************************************
			******************************************
			***THIS IS TO CHECK FOR THE LATE(END)****/
				
			/*****************************************
			******************************************
			*****THIS IS TO CHECK FOR THE UNDERTIME**/
				
			//If there is a undertime in am_logout
			if ($this->Helps->am_logout != 0)
			{
				$this->Tardiness->check_tardiness($this->employee_id, $this->log_date, $logType = 2, 
								$numberOfSeconds = $this->Helps->am_logout);
			}
			
			// If there is a undertime in pm_logout
			if ($this->Helps->pm_logout != 0)
			{
				$this->Tardiness->check_tardiness($this->employee_id, $this->log_date, $logType = 4, 
								$numberOfSeconds = $this->Helps->pm_logout);
			}

			// Undertime count (number of undertime
			$this->undertime_count += $this->Helps->count_undertime;
					
			//undertime counter (minutes or hours late)
			$this->undertime_final = $this->undertime_final + $this->Helps->hours_undertime;
					
			/*****************************************
			******************************************
			***THIS IS TO CHECK FOR THE UNDERTIME(END)*/
				
			//OVERTIME
			if($this->ot_login!="" && $this->ot_logout!="")
			{
				//$overtime += strtotime($this->ot_logout) - strtotime('05:00');
				$this->overtime += strtotime($this->ot_logout) - strtotime($this->ot_login);
			}
				
				
			
		}
		
		// NUMBER OF HOURS WORKED
		$this->number_of_hours_work += $this->Helps->count_hours_work($this->am_login, $this->am_logout);
		$this->number_of_hours_work += $this->Helps->count_hours_work($this->pm_login, $this->pm_logout);
		$this->number_of_hours_work += $this->Helps->count_hours_work($this->ot_login, $this->ot_logout);
	}
	
	// --------------------------------------------------------------------
	
	function shifting_same_day()
	{
		// We need to check the schedule
		$sched = $this->Schedule_employees->get_schedule($this->employee_id, $this->log_date);
		
		if (!empty($sched))
		{
			$this->time_a = $sched['hour_from'];
			$this->time_b = $sched['hour_to'];
			
			//$this->time_a = $sched['hour_from'];
			//$this->time_b = $sched['hour_to'];
		}
		
		//$this->time_a = '14:00';
		//$this->time_b = '22:00';
		
		//$this->time_a = '22:00';
		//$this->time_b = '06:00';
		
		//$this->time_a = '06:00';
		//$this->time_b = '14:00';
		
		//$this->time_a = '24';
		//$this->time_b = '24';
		
		// If morning in and afternoon out ================================================================
		if ($this->time_a < '12:00' && $this->time_b > '12:00')
		{
			// Check late
			$late = $this->Helps->check_late_8hrs($this->am_login, $this->time_a, 'am_login');
			
			// Delete tardiness if we get zero
			$this->Tardiness->delete_tardiness(
												$this->employee_id, 
												$this->log_date, 
												$this->Helps->am_login
												);
			
			// If there is a late in am_login
			if ($this->Helps->am_login != 0)
			{
				$this->Tardiness->check_tardiness($this->employee_id, 
												  $this->log_date, 
												  $logType = 1, 
												  $numberOfSeconds = $this->Helps->am_login
												  );
			}
			
			$log1 = $this->pm_logout;
			
			// If no pm out but there is am out
			if ($this->pm_logout == ''  && $this->am_logout !='')
			{
				$log1 = $this->am_logout;
			}
			// Check Undertime
			$undertime = $this->Helps->check_undertime_8hrs($log1, $this->time_b, 'pm_logout');
			
			// If there is a undertime in pm_logout
			if ($this->Helps->pm_logout != 0)
			{
				$this->Tardiness->check_tardiness($this->employee_id, 
												  $this->log_date, 
												  $logType = 4, 
												  $numberOfSeconds = $this->Helps->pm_logout
												  );
			}
			
			// Number of hours worked
			$this->number_of_hours_work += $this->Helps->count_hours_work_8hrs($this->am_login, $log1);
			
			list($log_year, $log_month, $log_day) = explode('-', $this->log_date);
			
			// Check the day in 1st week
			if (in_array($log_day, $this->week1_days))
			{
				$this->week1_hours 				+= $this->Helps->count_hours_work_8hrs($this->am_login, $log1);
				
				// Total Tardy for first week 1
				$this->week1_total_tardiness 	+= $this->Helps->am_login + $this->Helps->pm_logout;
				
				// Late and undertime count for the week 1
				$this->week1_late_count 		+= $this->Helps->count_late;
				$this->week1_undertime_count 	+= $this->Helps->count_undertime;
				
				// Weekl 1 late and undertime
				$this->week1_late_final 		+= $this->Helps->am_login;
				$this->week1_undertime_final 	+= $this->Helps->pm_logout;
			}
			
			// Check the day in 2nd week
			if (in_array($log_day, $this->week2_days))
			{
				$this->week2_hours 				+= $this->Helps->count_hours_work_8hrs($this->am_login, $log1);
				
				// Tardy for second week
				$this->week2_total_tardiness 	+= $this->Helps->am_login + $this->Helps->pm_logout;
			
				// Late and undertime count for the week 2
				$this->week2_late_count 		+= $this->Helps->count_late;
				$this->week2_undertime_count 	+= $this->Helps->count_undertime;
				
				// Week 2 late and undertime
				$this->week2_late_final 		+= $this->Helps->am_login;
				$this->week2_undertime_final 	+= $this->Helps->pm_logout;
				
			}
			
			// Check the day in 3rd week
			if (in_array($log_day, $this->week3_days))
			{
				$this->week3_hours 				+= $this->Helps->count_hours_work_8hrs($this->am_login, $log1);
				
				// Tardy for third week
				$this->week3_total_tardiness 	+= $this->Helps->am_login + $this->Helps->pm_logout;
			
				// Late and undertime count for the week 3
				$this->week3_late_count 		+= $this->Helps->count_late;
				$this->week3_undertime_count 	+= $this->Helps->count_undertime;
				
				// Week 3 late and undertime
				$this->week3_late_final 		+= $this->Helps->am_login;
				$this->week3_undertime_final 	+= $this->Helps->pm_logout;
			}
			
			// Check the day in 4th week
			if (in_array($log_day, $this->week4_days))
			{
				$this->week4_hours 				+= $this->Helps->count_hours_work_8hrs($this->am_login, $log1);
				
				// Tardy for fourth week
				$this->week4_total_tardiness 	+= $this->Helps->am_login + $this->Helps->pm_logout;
			
				// Late and undertime count for the week 4
				$this->week4_late_count 		+= $this->Helps->count_late;
				$this->week4_undertime_count 	+= $this->Helps->count_undertime;
				
				// Week 4 late and undertime
				$this->week4_late_final 		+= $this->Helps->am_login;
				$this->week4_undertime_final 	+= $this->Helps->pm_logout;
			}
			
			if ($this->ot_logout != "" && $this->ot_login != "")
			{
				$this->overtime += strtotime($this->ot_logout) - strtotime($this->ot_login);
			}
			
			
		}// ==============================================================================================
		
		// If same pm ====================================================================================
		if ($this->time_a >= '12:00' && $this->time_b >= '12:00')
		{
			// Check late
			$this->Helps->check_late_8hrs($this->pm_login, $this->time_a, 'pm_login');
			
			// Delete tardiness if we get zero
			$this->Tardiness->delete_tardiness(
												$this->employee_id, 
												$this->log_date, 
												$this->Helps->pm_login
												);
			
			// If there is a late in pm_login
			if ($this->Helps->pm_login != 0)
			{
				$this->Tardiness->check_tardiness($this->employee_id, 
												  $this->log_date, 
												  $logType = 3, 
												  $numberOfSeconds = $this->Helps->pm_login
												  );
												  
			}
			
			// Check Undertime
			$this->Helps->check_undertime_8hrs($this->pm_logout, $this->time_b, 'pm_logout');
			
			// If there is a undertime in pm_logout
			if ($this->Helps->pm_logout != 0)
			{
				$this->Tardiness->check_tardiness($this->employee_id, 
												  $this->log_date, 
												  $logType = 4, 
												  $numberOfSeconds = $this->Helps->pm_logout
												  );
			}
			
			// Number of hours worked
			$this->number_of_hours_work += $this->Helps->count_hours_work_8hrs($this->pm_login, $this->pm_logout);
			
			list($log_year, $log_month, $log_day) = explode('-', $this->log_date);
			
			// Check the day in 1st week
			if (in_array($log_day, $this->week1_days))
			{
				$this->week1_hours 				+= $this->Helps->count_hours_work_8hrs($this->pm_login, $this->pm_logout);
				
				// Total Tardy for first week 1
				$this->week1_total_tardiness 	+= $this->Helps->pm_login + $this->Helps->pm_logout;
				
				// Late and undertime count for the week 1
				$this->week1_late_count 		+= $this->Helps->count_late;
				$this->week1_undertime_count 	+= $this->Helps->count_undertime;
				
				// Weekl 1 late and undertime
				$this->week1_late_final 		+= $this->Helps->pm_login;
				$this->week1_undertime_final 	+= $this->Helps->pm_logout;
			}
			//echo $this->week1_total_tardiness.'<br>';
			// Check the day in 2nd week
			if (in_array($log_day, $this->week2_days))
			{
				$this->week2_hours 				+= $this->Helps->count_hours_work_8hrs($this->pm_login, $this->pm_logout);
				
				// Tardy for second week
				$this->week2_total_tardiness 	+= $this->Helps->pm_login + $this->Helps->pm_logout;
			
				// Late and undertime count for the week 2
				$this->week2_late_count 		+= $this->Helps->count_late;
				$this->week2_undertime_count 	+= $this->Helps->count_undertime;
				
				// Week 2 late and undertime
				$this->week2_late_final 		+= $this->Helps->pm_login;
				$this->week2_undertime_final 	+= $this->Helps->pm_logout;
				
			}
			
			// Check the day in 3rd week
			if (in_array($log_day, $this->week3_days))
			{
				$this->week3_hours 				+= $this->Helps->count_hours_work_8hrs($this->pm_login, $this->pm_logout);
				
				// Tardy for third week
				$this->week3_total_tardiness 	+= $this->Helps->pm_login + $this->Helps->pm_logout;
			
				// Late and undertime count for the week 3
				$this->week3_late_count 		+= $this->Helps->count_late;
				$this->week3_undertime_count 	+= $this->Helps->count_undertime;
				
				// Week 3 late and undertime
				$this->week3_late_final 		+= $this->Helps->pm_login;
				$this->week3_undertime_final 	+= $this->Helps->pm_logout;
			}
			
			// Check the day in 4th week
			if (in_array($log_day, $this->week4_days))
			{
				$this->week4_hours 				+= $this->Helps->count_hours_work_8hrs($this->pm_login, $this->pm_logout);
				
				// Tardy for fourth week
				$this->week4_total_tardiness 	+= $this->Helps->pm_login + $this->Helps->pm_logout;
			
				// Late and undertime count for the week 4
				$this->week4_late_count 		+= $this->Helps->count_late;
				$this->week4_undertime_count 	+= $this->Helps->count_undertime;
				
				// Week 4 late and undertime
				$this->week4_late_final 		+= $this->Helps->pm_login;
				$this->week4_undertime_final 	+= $this->Helps->pm_logout;
			}
			
		}// ==============================================================================================
		
		
		// If afternoon in(night) and morning out ========================================================
		if ($this->time_a >= '12:00' && $this->time_b < '12:00')
		{
			// Check late
			$this->Helps->check_late_8hrs($this->pm_login, $this->time_a, 'pm_login');
			
			// Delete tardiness if we get zero
			$this->Tardiness->delete_tardiness(
												$this->employee_id, 
												$this->log_date, 
												$this->Helps->pm_login
												);
			
			// If there is a late in pm_login
			if ($this->Helps->pm_login != 0)
			{
				$this->Tardiness->check_tardiness($this->employee_id, 
												  $this->log_date, 
												  $logType = 3, 
												  $numberOfSeconds = $this->Helps->pm_login
												  );
												  
			}
			
			if ($this->am_logout != '')
			{
				// Delete tardiness if we get zero
				$this->Tardiness->delete_tardiness(
													$this->employee_id, 
													$this->log_date, 
													$this->Helps->am_logout
													);
				
				// Check Undertime
				$this->Helps->check_undertime_8hrs($this->am_logout, $this->time_b, 'am_logout');
				
				// If there is a undertime in am_logout
				if ($this->Helps->am_logout != 0)
				{
					$this->Tardiness->check_tardiness($this->employee_id, 
													  $this->log_date, 
													  $logType = 2, 
													  $numberOfSeconds = $this->Helps->am_logout
													  );
				}
			}
			
			
			list($log_year, $log_month, $log_day) = explode('-', $this->log_date);
			
			// Get the date for tomorrow
			$date_tom = $this->Dtr->date_tom($this->log_date, $this->employee_id);
			
			// Number of hours worked
			$this->number_of_hours_work += $this->Helps->count_hours_work_8hrs(
															$this->log_date.' '.$this->pm_login, 
															$date_tom['log_date'].' '.$date_tom['am_logout']
															);
			
			// Check the day in 1st week
			if (in_array($log_day, $this->week1_days))
			{
				if ($this->pm_login != '' && $date_tom['am_logout'] != '')
				{
					$this->week1_hours 				+= $this->Helps->count_hours_work_8hrs(
														$this->log_date.' '.$this->pm_login, 
														$date_tom['log_date'].' '.$date_tom['am_logout']
														);
				}
				
				
				// Total Tardy for first week 1
				//$this->week1_total_tardiness 	+= $this->Helps->pm_login + $this->Helps->pm_logout;
				
				// Late and undertime count for the week 1
				$this->week1_late_count 		+= $this->Helps->count_late;
				$this->week1_undertime_count 	+= $this->Helps->count_undertime;
				
				// Weekl 1 late and undertime
				$this->week1_late_final 		+= $this->Helps->pm_login;
				$this->week1_undertime_final 	+= $this->Helps->pm_logout;
			}
			//echo $this->week1_total_tardiness.'<br>';
			// Check the day in 2nd week
			if (in_array($log_day, $this->week2_days))
			{
				//$this->week2_hours 				+= $this->Helps->count_hours_work_8hrs($this->pm_login, $this->pm_logout);
				
				if ($this->pm_login != '' && $date_tom['am_logout'] != '')
				{
					$this->week2_hours 				+= $this->Helps->count_hours_work_8hrs(
														$this->log_date.' '.$this->pm_login, 
														$date_tom['log_date'].' '.$date_tom['am_logout']
														);
				}
				
				// Tardy for second week
				//$this->week2_total_tardiness 	+= $this->Helps->pm_login + $this->Helps->pm_logout;
			
				// Late and undertime count for the week 2
				$this->week2_late_count 		+= $this->Helps->count_late;
				$this->week2_undertime_count 	+= $this->Helps->count_undertime;
				
				// Week 2 late and undertime
				$this->week2_late_final 		+= $this->Helps->pm_login;
				$this->week2_undertime_final 	+= $this->Helps->pm_logout;
				
			}
			
			// Check the day in 3rd week
			if (in_array($log_day, $this->week3_days))
			{
				//$this->week3_hours 				+= $this->Helps->count_hours_work_8hrs($this->pm_login, $this->pm_logout);
				
				if ($this->pm_login != '' && $date_tom['am_logout'] != '')
				{
					$this->week3_hours 				+= $this->Helps->count_hours_work_8hrs(
														$this->log_date.' '.$this->pm_login, 
														$date_tom['log_date'].' '.$date_tom['am_logout']
														);
				}
				
				// Tardy for third week
				//$this->week3_total_tardiness 	+= $this->Helps->pm_login + $this->Helps->pm_logout;
			
				// Late and undertime count for the week 3
				$this->week3_late_count 		+= $this->Helps->count_late;
				$this->week3_undertime_count 	+= $this->Helps->count_undertime;
				
				// Week 3 late and undertime
				$this->week3_late_final 		+= $this->Helps->pm_login;
				$this->week3_undertime_final 	+= $this->Helps->pm_logout;
			}
			
			// Check the day in 4th week
			if (in_array($log_day, $this->week4_days))
			{
				//$this->week4_hours 				+= $this->Helps->count_hours_work_8hrs($this->pm_login, $this->pm_logout);
				
				if ($this->pm_login != '' && $date_tom['am_logout'] != '')
				{
					$this->week4_hours 				+= $this->Helps->count_hours_work_8hrs(
														$this->log_date.' '.$this->pm_login, 
														$date_tom['log_date'].' '.$date_tom['am_logout']
														);
				}
				
				// Tardy for fourth week
				//$this->week4_total_tardiness 	+= $this->Helps->pm_login + $this->Helps->pm_logout;
			
				// Late and undertime count for the week 4
				$this->week4_late_count 		+= $this->Helps->count_late;
				$this->week4_undertime_count 	+= $this->Helps->count_undertime;
				
				// Week 4 late and undertime
				$this->week4_late_final 		+= $this->Helps->pm_login;
				$this->week4_undertime_final 	+= $this->Helps->pm_logout;
			}
			
		}// ==============================================================================================
		
		// If 24hrs (hour_from is the same as hour_to)====================================================
		if ( ($this->time_a == $this->time_b ) && ($this->time_a != '' && $this->time_b != '') )
		{
			// Get the am_login as login. if am_login is blank check for pm_login 
			// and use as login.
			// Get the am_logout as logout. if am_logout is blank check for pm_logout
			// and use as logout.
			
			list($log_year, $log_month, $log_day) = explode('-', $this->log_date);
			
			// Get the date for tomorrow
			$date_tom = $this->Dtr->date_tom($this->log_date, $this->employee_id);
			
			$login 	= '';
			$logout = '';
			
			$log_type = '';
			
			if ($this->am_login != '' && $this->pm_login == '')
			{
				$login 	= $this->am_login;
				$logout = $date_tom['am_logout'];
				
				$log_type = 'am_login';
			}
			if ($this->am_login == '' && $this->pm_login != '')
			{
				$login = $this->pm_login;
				$logout = $date_tom['pm_logout'];
				$log_type = 'pm_logout';
			}
			
			// Check late
			$this->Helps->check_late_8hrs($login, $this->time_a, $log_type);
			
			// Delete tardiness if we get zero
			$this->Tardiness->delete_tardiness(
												$this->employee_id, 
												$this->log_date, 
												$login
												);
			
			
			
			// Number of hours worked
			if ($login != '' && $logout != '')
			{
				$this->number_of_hours_work += $this->Helps->count_hours_work_8hrs(
																$this->log_date.' '.$login, 
																$date_tom['log_date'].' '.$logout
																);
			}
			
			// Check the day in 1st week
			if (in_array($log_day, $this->week1_days))
			{
				if ($login != '' && $logout != '')
				{
					$this->week1_hours 				+= $this->Helps->count_hours_work_8hrs(
														$this->log_date.' '.$login, 
														$date_tom['log_date'].' '.$logout
														);
				}
				
			}
			
			// Check the day in 2nd week
			if (in_array($log_day, $this->week2_days))
			{
				
				if ($login != '' && $logout != '')
				{
					$this->week2_hours 				+= $this->Helps->count_hours_work_8hrs(
														$this->log_date.' '.$login, 
														$date_tom['log_date'].' '.$logout
														);
				}
				
			}
			
			// Check the day in 3rd week
			if (in_array($log_day, $this->week3_days))
			{
				if ($login != '' && $logout != '')
				{
					$this->week3_hours 				+= $this->Helps->count_hours_work_8hrs(
														$this->log_date.' '.$login, 
														$date_tom['log_date'].' '.$logout
														);
				}
			}
			
			// Check the day in 4th week
			if (in_array($log_day, $this->week4_days))
			{
				if ($login != '' && $logout != '')
				{
					$this->week4_hours 				+= $this->Helps->count_hours_work_8hrs(
														$this->log_date.' '.$login, 
														$date_tom['log_date'].' '.$logout
														);
				}
				
			}
			
			//echo '24';
		}
		
		
		// late count (number of lates)
		$this->late_count += $this->Helps->count_late;
				
		// late counter (minutes or hours late)
		$this->late_final = $this->late_final + $this->Helps->hours_late;
		
		// Undertime count
		$this->undertime_count += $this->Helps->count_undertime;
		
		// Minutes or hour undertime
		$this->undertime_final = $this->undertime_final + $this->Helps->hours_undertime;
		
		
		// to do: if the no login or logout. should we consider that as halfday( meaning tardy if
		// morning and undertime if afternoon
		
		if ($this->Helps->hours_late != 0)
		{
			//echo $this->Helps->hours_late;
		}
	}
	
	function shifting_24()
	{
			
	}
	
	// --------------------------------------------------------------------
	
	function leave_card_undertime()
	{
		//echo $this->total_tardiness.'hehe';
		
		$card_month = $this->Helps->get_month_name($this->month);
				
		$action_take = substr($card_month, 0, 3).'. '.$this->year.' Undertime'; 
		
		$is_entry_exists = $this->Leave_card->is_entry_exists($this->employee_id, $action_take);
		
		$this->Helps->compute_time($this->total_tardiness, 1);
		
		$particulars = 'UT-'.$this->Helps->days.'-'.$this->Helps->hours.'-'.$this->Helps->minutes;
		
		$last_day = $this->Helps->get_last_day($this->month, $this->year);
		
		$last_day = $this->year.'-'.$this->month.'-'.$last_day;
		
		$v_abs = $this->Conversion_table->compute_hour_minute($this->total_tardiness);
		
		// Deductions to leave credit but not final =======================================
	
		// If not zero undertime
		if ($particulars != 'UT-0-0-0')
		{
			if ($is_entry_exists == TRUE)
			{
				// edit
				$this->Leave_card->update_entry($this->employee_id, $particulars, $v_abs, $action_take, $last_day, 0);
			}
			else
			{
				// insert
				$this->Leave_card->insert_entry($this->employee_id, $particulars, $v_abs, $action_take, $last_day, 0);
				
			}
		}
		else
		{
			// If no late or undertime
			$this->Leave_card->delete_undertime($this->employee_id, $last_day);
		}
	}
	
}

/* End of file dtr_manage.php */
/* Location: ./application/modules/dtr_manage/controllers/dtr_manage.php */