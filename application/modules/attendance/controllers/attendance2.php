<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Integrated Human Resource Management Information System
 *
 * An Open source Application Software use by Government agencies for 
 * management of employees Attendance, Leave Administration, Payroll, 
 * Personnel Training, Service Records, Performance, Recruitment,
 * Personnel Schedule(Plantilla) and more...
 *
 * @package		iHRMIS
 * @author		Manny Isles
 * @copyright	Copyright (c) 2008 - 2013, Charliesoft
 * @license		http://charliesoft.net/ihrmis/license
 * @link		http://charliesoft.net
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * iHRMIS Clients Class
 *
 * This class use for managing workstations of iHRMIS
 *
 * @package		iHRMIS
 * @subpackage	Models
 * @category	Models
 * @author		Manny Isles
 * @link		http://charliesoft.net/hrmis/user_guide/models/clients.html
 */
class Attendance extends MX_Controller {

	// --------------------------------------------------------------------
	
	public $array_pdf 				= array();
	
	public $employee_array			= array();
	
	public $employee_id				= '';
	
	public $month					= '';
	
	public $year					= '';
	
	public $period_from				= '';
	
	public $period_to				= '';
	
	public $dont_compute_dates		= '';
	
	public $sat_or_sun				= '';
	
	public $is_holiday				= FALSE;
	
	public $late_final 				= 0;	// Late counter (minutes or hours late)
	
	public $late_count 				= 0;	// Late count (number of lates
	
	public $undertime_final 		= 0;	// Undertime
	
	public $undertime_count 		= 0;	// Undertime count (number of undertime)
	
	public $total_tardiness			= 0;
	
	public $line_number 			= 1;	// Where the writing in pdf should.
	
	public $number_of_days 			= 0;	// Number of days work

	public $final_over_time 		= 0;	// Number of overtime
	
	public $overtime 				= 0;	// Overtime
	
	public $number_of_hours_work 	= 0;	// Number of hours worked
	
	public $shift_type				= 1;
	
	public $am_login				= '';
	
	public $am_logout				= '';
	
	public $pm_login				= '';
	
	public $pm_logout				= '';
	
	public $ot_login				= '';
	
	public $ot_logout				= '';
	
	public $leave_type_id			= '';
	
	public $log_date				= ''; 
	
	public $manual_log_id			= '';
	
	public $time_a					= '08:00';
	public $time_b					= '12:00';
	public $time_c					= '13:00';
	public $time_d					= '17:00';	
	
	public $allow_40hrs				= FALSE;	// Allow 40 hrs per week
	
	public $week1_hours				= 0;		// Day 1 - 8
	public $week2_hours				= 0;		// Day 9 - 15
	public $week3_hours				= 0;		// Day 16 - 22
	public $week4_hours				= 0;		// Day 23 - 31
	
	public $week1_days				= array('01', '02', '03', '04', '05', '06', '07');
	public $week2_days				= array('08', '09', '10', '11', '12', '13', '14', '15');
	public $week3_days				= array('16', '17', '18', '19', '20', '21', '22');
	public $week4_days				= array('23', '24', '25', '26', '27', '28', '28', '30', '31');
	
	public $week1_total_tardiness	= 0;		// Total of hours tardy
	public $week2_total_tardiness	= 0;
	public $week3_total_tardiness	= 0;
	public $week4_total_tardiness	= 0;
	
	public $week1_late_count		= 0;		// Total of late count
	public $week2_late_count		= 0;
	public $week3_late_count		= 0;
	public $week4_late_count		= 0;
	
	public $week1_late_final		= 0;		// Total of weekly late
	public $week2_late_final		= 0;		
	public $week3_late_final		= 0;		
	public $week4_late_final		= 0;		
	
	public $week1_undertime_count	= 0;		// Total of undertime count
	public $week2_undertime_count	= 0;
	public $week3_undertime_count	= 0;
	public $week4_undertime_count	= 0;
	
	public $week1_undertime_final	= 0;		// Total of weekly undertime
	public $week2_undertime_final	= 0;		
	public $week3_undertime_final	= 0;		
	public $week4_undertime_final	= 0;		
	
	public $start_date				= 1;
	
	public $pdf						= '';
	
	public $friday_exempted			= 'no';

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		//$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		//$this->output->enable_profiler(TRUE);
    }  
	
	// --------------------------------------------------------------------
	
	function view_attendance()
	{
		$data['page_name'] = '<b>View Attendance</b>';
		$data['msg'] = '';
		
		$data['focus_field']		= '';
		
		$dtr2 = $this->input->post('dtr2');
		
		// If view DTR
		if ($dtr2)
		{
			$office_id 						= $this->input->post('office_id');
			$employee_id 					= $this->input->post('employee_id');
			
			$date 							= $this->input->post('date'); 
			$date2   						= $this->input->post('date2'); 
			
			
			// Use to view dtr
			$_GET['office_id']	 			= $this->input->post('office_id');
			$_GET['employee_id'] 			= $this->input->post('employee_id');
			$_GET['date']					= $this->input->post('date');
			$_GET['date2']					= $this->input->post('date2');
			$_GET['from_view_attendance']	= TRUE;
			
			// Generate the DTR
			$this->dtr();
			
			$office_id 						= $this->input->post('office_id');// added 2011-02-14
			?>
			<script src="<?php echo base_url();?>js/function.js"></script>
			<script>openBrWindow('<?php echo base_url()."dtr/archives/".$office_id.".pdf";?>','','scrollbars=yes,width=800,height=700')</script>
			<?php
		}
		
		$data['options'] 					= $this->options->office_options();
		$data['selected'] 					= $this->session->userdata('office_id');
		
		// Added 1.11.2012
		if ( $this->session->userdata('user_type') == 5)
  		{
			$office_name 		= $this->Office->get_office_name($this->session->userdata('office_id'));
			$data['options'] 	= array($this->session->userdata('office_id') => $office_name);
		}
		// end add
		
		$data['date'] 						= date("Y-m-d");
		$data['date2'] 						= date("Y-m-d");
		
		// View DTR
		if ($this->input->post('op'))
		{
			$double_incomplete 				= $this->input->post('double_incomplete');
			
			$this_only 						= $this->input->post('this_only');
			
			$data['selected'] 				= $this->input->post('office_id');
			
			if ($this_only)
			{
				$_POST['date2'] 			= $this->input->post('date');
			}
			
			if($this->input->post('employee_id') == 'Employee ID')
			{
				$_POST['employee_id'] 		= '';
			}
			
			if ($double_incomplete == 1)
			{
				$this->Dtr->double_incomplete = TRUE;
			}
			
			$data['rows'] = $this->Dtr->get_office_dtr(
										 $this->input->post('office_id'), 
										 $this->input->post('date'), 
										 $this->input->post('date2'), 
										 $this->input->post('employee_id')
										 );
		
			$data['date'] = $this->input->post('date');
			$data['date2'] = $this->input->post('date2');
		}
		else // If view DTR initial
		{
			$data['rows'] = $this->Dtr->get_office_dtr(
										$this->session->userdata('office_id'), 
										$data['date'], 
										$data['date']
										);
			
		}
		
		$total_employee = $this->Employee->num_rows;
				
		$data['main_content'] = 'view_attendance';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
		
	function dtr()
	{
		$data['page_name'] = '<b>View/Print DTR</b>';
		$data['msg'] = '';
		
		$data['focus_field']		= 'employee_id';
				
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
		
		// Period to
		$data['days_options'] 		= $this->options->days_options();
		$data['days_selected'] 		= date('d');
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		$show_employee_number_dtr = $this->Settings->get_selected_field('show_employee_number_dtr');
		
		
		//If ($op == 1) ================== START ==========================
		if ($this->input->post('op') == 1)
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
			
			
			//$start_date = '1';
			
			// If the $this->period_from is not 1
			if ($this->period_from != '1')
			{
				$this->start_date = $this->input->post('period_from'); // Start of viewing DTR
				
				$this->period_from = '1'; // We will still use the first day
			}
			
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
											'friday_exempted', 
											'office_id',
											'detailed_office_id',
											'assistant_dept_head',
											);//Fields
				
				
				$name = $this->Employee->get_employee_info($this->employee_id);
				
				$this->friday_exempted = $name['friday_exempted'];
				
				//echo $this->friday_exempted;
				//exit;
				
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
				$this->pdf = new FPDI();
				// add a page
				$this->pdf->AddPage();
				// set the sourcefile
				$this->pdf->setSourceFile('dtr/template/dtr.pdf');
				
				// select the first page
				$tplIdx = $this->pdf->importPage(1);
				
				// use the page we imported
				$this->pdf->useTemplate($tplIdx);
				
				// set font, font style, font size.
				$this->pdf->SetFont('Times','B',11);
				
				####################################
				#THIS IS FOR THE NAME OF EMPLOYEE  #
				####################################
				
				if ($show_employee_number_dtr == 'yes')
				{
					$this->pdf->SetXY(80, 10);
				
					$this->pdf->Write(0, $this->employee_id);
					
					$this->pdf->SetX(175);
					
					$this->pdf->Write(0, $this->employee_id);
				}
				
				// set initial placement
				$this->pdf->SetXY(30, 22.5);
				
				// line break
				$this->pdf->Ln(5);
				
				// go to 25 X (indent)
				$this->pdf->SetX(40);
				
				// write
				$this->pdf->Write(0, ucwords(strtolower(utf8_decode($whole_name))));
				
				
				// go to 25 X (indent)
				$this->pdf->SetX(130);
				
				// write
				$this->pdf->Write(0, ucwords(strtolower(utf8_decode($whole_name))));
			
				########################################
				#THIS IS FOR THE NAME OF EMPLOYEE (END)#
				########################################
				
				
				####################################
				#THIS IS FOR THE MONTH             #
				####################################
				
				$month2 = $this->Helps->get_month_name($this->month);
			
				// line break
				$this->pdf->Ln(11);
				
				// go to 25 X (indent)
				$this->pdf->SetX(43);
				
				// write
				$this->pdf->Write(0, ucwords(strtolower($month2.' '.$this->start_date.'-'.$this->period_to.', '.$this->year)));
				
				
				// go to 25 X (indent)
				$this->pdf->SetX(137);
				
				// write
				$this->pdf->Write(0, ucwords(strtolower($month2.' '.$this->start_date.'-'.$this->period_to.', '.$this->year)));
			
				####################################
				#THIS IS FOR THE MONTH (END)       #
				####################################
			
			
				$this->pdf->Ln(28.5);
				$this->pdf->SetFont('Times','',9);
			
			
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
					$this->set_dtr($row); // 
					
					// Split the logged_date
					// As of PHP 5.3.0 the regex extension is deprecated, 
					// calling this function will issue an E_DEPRECATED notice.
					list($log_year, $log_month, $log_day) = explode('-', $this->log_date);
					
					
					// Check if the day is Sat or Sun
					$this->sat_or_sun = $this->Helps->is_sat_sun($log_month, $log_day, $log_year);
					
					// Check if the day is holiday
					$this->is_holiday = $this->Holiday->is_holiday($this->log_date);
					
					$allow_forty_hours = $this->Settings->get_selected_field('allow_forty_hours');
					
					// If the $this->period_from is not 1 something like
					// June 16-30 2012
					if ($this->start_date != '1')
					{
						if ($log_day < $this->start_date)
						{
							$this->am_login 		= '';
							$this->am_logout		= '';
							$this->pm_login 		= '';
							$this->pm_logout		= '';
							$this->ot_login 		= '';
							$this->ot_logout		= '';
							$this->sat_or_sun 		= '';
							$this->is_holiday 		= FALSE;

						}
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
					
					
					// Set the line number from where in the pdf position will be place
					$line_numbers = array(4, 6, 8, 11, 14, 17, 19, 21, 24, 28);
					
					$line_number_view = (in_array($this->line_number, $line_numbers)) ? 4 : 3.5;
					
					$this->pdf->Ln($line_number_view);
					
					// Check for saturdays and sundays
					
					// If the date has log on it
					if ($this->am_login 	!= "" 	or $this->am_logout != "" or $this->pm_login 	!= "" or 
						$this->pm_logout 	!= "" 	or $this->ot_login 	!= "" or $this->ot_logout 	!= "")
					{
						//Do nothing
						
						// If the date is holiday
						if ($this->is_holiday == TRUE)
						{
							// Lets check if the holiday is half day
							if ($this->Holiday->half_day == TRUE)
							{
								if ($this->Holiday->am_pm == 'am')
								{
									$this->am_login = strtoupper($this->Holiday->holiday_name($this->log_date));
								}
								else
								{
									$this->pm_login = strtoupper($this->Holiday->holiday_name($this->log_date));
								}
								
							}
						}
								
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
								
								if ($this->Holiday->am_pm == 'pm')
								{
									//$this->am_login = '';
								}
							}
							
						//}
						
						
					}
					
					
					// Lets check if the logs has atleast one OB in entries
					$has_ob = FALSE;
					
					$has_ob = $this->Helps->has_ob(
									$this->am_login, 
									$this->am_logout, 
									$this->pm_login, 
									$this->pm_logout
									);
									
					$ob_location = '';
					
					if ($has_ob == TRUE)
					{
						$ob_location = $this->Manual_log->get_notes($this->manual_log_id);
						
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
						$ob_location = '';
						
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
					
					
					
					// Check if Travel Order (Change Travel Order to To)
					$this->am_login 	= $this->Helps->is_to($this->am_login);
					$this->am_logout 	= $this->Helps->is_to($this->am_logout);
					$this->pm_login 	= $this->Helps->is_to($this->pm_login);
					$this->pm_logout 	= $this->Helps->is_to($this->pm_logout);
					
					// If whole day to
					if ($this->am_login == 'TO' && $this->am_logout == 'TO' && 
						$this->pm_login == 'TO' && $this->pm_logout == 'TO')
					{
						$notes = $this->Manual_log->get_notes($this->manual_log_id);
						
						if (trim($notes) == '')
						{
							$this->am_login 	= 'TO';
							$this->am_logout 	= 'TO';
							$this->pm_login 	= 'TO';
							$this->pm_logout 	= 'TO';
						}
						else
						{
							$this->am_login = 'Travel Order --';
							$this->am_logout 	= '';
							$this->pm_login 	= trim($notes);
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
					
					$am_is_leave = FALSE;
					
					// If half day leave (morning)
					if ($this->leave_type_id != 0 && $this->am_login == 'Leave' && $this->am_logout == 'Leave')
					{
						$this->am_login = strtoupper ($this->Leave_type->get_leave_code($this->leave_type_id));
						$this->am_logout= '';
						
						$am_is_leave = TRUE;
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
							//$this->am_login = 'Vacation Leave';
							//$this->am_login = 'Late';
							
							// Update 2.8.2013
							// Put Tardy only if not saturday or sunday
							if ($this->sat_or_sun != 'Saturday' and $this->sat_or_sun != 'Sunday' and $this->is_holiday == FALSE)
							{
								$this->am_login = 'Tardy';
								$this->am_logout= '';
								
								// Change font color
								$this->Helps->font_color_am_login = 200;
							}
							
							
						}
						
						// PM Absent
						if ($this->am_login != '' && $this->am_logout != '' && $this->pm_login == '' && $this->pm_logout == '')
						{
							//$this->pm_login = 'Vacation Leave';
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
							
							
							// add this lines 12.14.2012 8.37am
							/*
							if (
								$this->Holiday->is_holiday($this->log_date) and 
								$this->Holiday->half_day == TRUE and
								$this->Holiday->am_pm == 'pm'
								)
							{
			
								$this->pm_logout = '';
							}
							*/
							// end add 12.14.2012 8.37am
							
						}
						// PM Absent(no log out)
						else if($this->am_login != '' && $this->am_logout != '' && $this->pm_login != '' && $this->pm_logout == '')
						{							
							$this->pm_logout = 'Undertime';
							
							// add this lines 12.14.2012 8.37am
							if (
								$this->Holiday->is_holiday($this->log_date) and 
								$this->Holiday->half_day == TRUE and
								$this->Holiday->am_pm == 'pm'
								)
							{
			
								$this->pm_logout = '';
							}
							// end add 12.14.2012 8.37am
							
							// Check if saturday or sunday and shift_id == 1
							// if true we dont need to put undertime to DTR
							if ( $this->shift_type == 1 && ($this->sat_or_sun == 'Saturday' || $this->sat_or_sun == 'Sunday'))
							{
								$this->pm_logout = '';
							}
							
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
						//else if($this->am_login != '' && $this->am_logout == '' && $this->pm_login != '' && $this->pm_logout != '')
						else if($this->am_login != '' && $this->am_logout == '' && $this->pm_login != '' && $this->pm_logout != '' && $this->leave_type_id == 0)
						{
							$this->am_logout = 'Tardy';
							
							// If pm is leave
							if ($pm_is_leave == TRUE)
							{
								//$this->pm_logout = '';
							}
							
							//$this->leave_type_id
							
							// Change font color
							$this->Helps->font_color_am_logout = 200;
						}
						
						// no am log then OB for 3 entries 07.3.2012
						else if($this->am_login == '' && $this->am_logout == 'OB' && $this->pm_login == 'OB' && $this->pm_logout == 'OB' && $this->leave_type_id == 0)
						{
							$this->am_login = 'Tardy';
							
							// If pm is leave
							if ($pm_is_leave == TRUE)
							{
								//$this->pm_logout = '';
							}
														
							// Change font color
							$this->Helps->font_color_am_login = 200;
						}
					
					}
					
					
					
					//convert the time to 12 hour 
					
					//am login A
					$this->pdf->SetX(24);
					$this->pdf->SetTextColor($this->Helps->font_color_am_login, 0, 0);
					$this->pdf->SetFont('Times', $this->Helps->am_font_bold, 9);
					$this->pdf->Write(0, $this->am_login);
					
					
					//am login B
					$this->pdf->SetX(118);
					$this->pdf->Write(0, $this->am_login);
					$this->Helps->font_color_am_login = 0;
					$this->Helps->am_font_bold = '';
					
					//am logout A
					$this->pdf->SetX(36);
					$this->pdf->SetTextColor($this->Helps->font_color_am_logout, 0, 0);
					$this->pdf->SetFont('Times', $this->Helps->am_out_bold, 9);
					$this->pdf->Write(0, $this->am_logout);
					
					//am logout B
					$this->pdf->SetX(130);
					$this->pdf->Write(0, $this->am_logout);
					$this->Helps->font_color_am_logout = 0;
					$this->Helps->am_out_bold = '';
				
					//pm login A
					$this->pdf->SetX(50);
					$this->pdf->SetTextColor($this->Helps->font_color_pm_login, 0, 0);
					$this->pdf->SetFont('Times', $this->Helps->pm_font_bold, 9);
					
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
							
							
							// add this lines 12.14.2012 8.37am
							
							if (
								$this->Holiday->is_holiday($this->log_date) and 
								$this->Holiday->half_day == TRUE and
								$this->Holiday->am_pm == 'pm'
								)
							{
			
								$this->pm_login = $this->Holiday->holiday_name($this->log_date);
							}
							
							// end add 12.14.2012 8.37am
						}
						
						// If leave in the pm and pm_login is not equal to leave code(VL, SPL)
						if( $this->leave_type_id != 0 && $this->pm_login != strtoupper ($this->Leave_type->get_leave_code($this->leave_type_id)) )
						{
							$this->pm_login = $this->Helps->change_format($this->pm_login, 1, $format = '');
						}
						
					}
					
					// Reset the notes to blank
					$notes = '';
					
					$this->pdf->Write(0, $this->pm_login);
					
					//pm login B
					$this->pdf->SetX(144);
					$this->pdf->Write(0, $this->pm_login);
					$this->Helps->font_color_pm_login = 0;
					$this->Helps->pm_font_bold = '';
				
					//pm logout A
					$this->pdf->SetX(62);
					$this->pdf->SetTextColor($this->Helps->font_color_pm_logout, 0, 0);
					$this->pdf->SetFont('Times', $this->Helps->pm_out_bold, 9);
					
					// Change format if the entry is not leave and not Undertime or (leave in the morning)
					if( ($this->leave_type_id == 0 && $this->pm_logout != 'Undertime') or $am_is_leave == TRUE)
					{
						$this->pm_logout = $this->Helps->change_format($this->pm_logout, 1, $format = '');
					}
					$this->pdf->Write(0, $this->pm_logout);
					
					//pm logout B
					$this->pdf->SetX(157);
					$this->pdf->Write(0, $this->pm_logout);
					$this->Helps->font_color_pm_logout = 0;
					$this->Helps->pm_out_bold = '';

					
					//ot login A
					$this->pdf->SetX(74);
					$this->pdf->SetTextColor(0, 0, 0);
					
					
					if ($has_ob == TRUE and trim($ob_location) != '')
					{
						$this->ot_login = $ob_location;
					}
					else
					{
						$this->ot_login = $this->Helps->change_format($this->ot_login, 1, $format = '');
					}
					
					$this->pdf->Write(0, $this->ot_login);
					
					//ot login B
					$this->pdf->SetX(169);
					$this->pdf->SetTextColor(0, 0, 0);
					$this->pdf->Write(0, $this->ot_login);
				
					//ot logout A
					$this->pdf->SetX(88);
					$this->pdf->SetTextColor(0, 0, 0);
					$this->ot_logout = $this->Helps->change_format($this->ot_logout, 1, $format = '');
					$this->pdf->Write(0, $this->ot_logout);
					
					//ot logout B
					$this->pdf->SetX(182);
					$this->pdf->SetTextColor(0, 0, 0);
					$this->pdf->Write(0, $this->ot_logout);
					
					$this->line_number++ ;
					
					$this->Holiday->half_day = FALSE; // reset
					
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
				$this->pdf->SetXY(30, 34);
				//$this->pdf->Ln(160.5);
				$this->pdf->Ln(153);
				//total A
				$this->pdf->SetX(50);
				//$this->pdf->Write(0, ucwords(($this->Helps->compute_time($this->number_of_hours_work))));
				//total B
				$this->pdf->SetX(145);
				//$this->pdf->Write(0, ucwords(($this->Helps->compute_time($this->number_of_hours_work))));
				
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
				$this->pdf->Ln(48);
				$this->pdf->SetX(17);
				$this->pdf->Write(0, 'Tardiness:');
				
				$this->pdf->SetX(40);
				$this->pdf->Write(0, '('.$this->late_count.'x)' .$this->late_final);
				
				
				$this->pdf->SetX(110);
				$this->pdf->Write(0, 'Tardiness:');
				
				$this->pdf->SetX(133);
				$this->pdf->Write(0, '('.$this->late_count.'x)' .$this->late_final);
				
				$this->pdf->Ln(6);
				
				$this->pdf->SetX(17);
				$this->pdf->Write(0, 'Under time:');
				$this->pdf->SetX(40);
				
				if ( $lgu_code == 'marinduque_province' )
				{
					$this->pdf->Write(0, $this->undertime_final);
				}
				else
				{
					$this->pdf->Write(0, '('.$this->undertime_count.'x) ' .$this->undertime_final);
				}
				
				
				
				$this->pdf->SetX(110);
				$this->pdf->Write(0, 'Under time:');
				
				$this->pdf->SetX(133);
				if ( $lgu_code == 'marinduque_province' )
				{
					$this->pdf->Write(0, $this->undertime_final);
				}
				else
				{
					$this->pdf->Write(0, '('.$this->undertime_count.'x) ' .$this->undertime_final);
				}
				
				//overtime
				$this->pdf->Ln(6);
				$this->number_of_hours_work = $this->Helps->compute_time($this->number_of_hours_work);
				$this->pdf->SetX(17);
				//$this->pdf->Write(0, ucwords(('Number of Tardiness:')));
				
				$this->pdf->SetX(50);
				//$this->pdf->Write(0, ucwords(($late_count + $undertime_count)));
				
				$this->pdf->SetX(110);
				//$this->pdf->Write(0, ucwords(('Number of Tardiness:')));
				
				$this->pdf->SetX(143);
				//$this->pdf->Write(0, ucwords(($late_count + $undertime_count)));
				
				
				//overtime
				$this->overtime = $this->Helps->compute_time($this->overtime);
				
				$print_overtime_in_dtr = $this->Settings->get_selected_field( 'print_overtime_in_dtr' );
				
				if ( $print_overtime_in_dtr == 1)
				{
					$this->pdf->SetX(17);
					$this->pdf->Write(0, ucwords(('Over time:')));
					$this->pdf->Write(0, ucwords(($this->overtime)));
					
					
					$this->pdf->SetX(110);
					$this->pdf->Write(0, ucwords(('Over time:')));
					$this->pdf->Write(0, ucwords(($this->overtime)));
				}
				
				// If allow the 40 hrs per week
				if ($this->allow_40hrs == TRUE)
				{
					$this->pdf->Ln(6);
					$this->pdf->SetX(17);
					$this->pdf->Write(0, ('The system allow the 40 hrs a week'));
					
					$this->pdf->SetX(110);
					$this->pdf->Write(0, ('The system allow the 40 hrs a week'));
					
					// We require hours only here.
					$this->Helps->hours_only = TRUE;
					
					$this->pdf->Ln(4);
					$this->pdf->SetX(17);
					$this->pdf->Write(0, ('1st week: '.$this->Helps->compute_time($this->week1_hours)));
					
					$this->pdf->SetX(110);
					$this->pdf->Write(0, ('1st week: '.$this->Helps->compute_time($this->week1_hours)));
					
					$this->pdf->Ln(4);
					$this->pdf->SetX(17);
					$this->pdf->Write(0, ('2nd week: '.$this->Helps->compute_time($this->week2_hours)));
					
					$this->pdf->SetX(110);
					$this->pdf->Write(0, ('2nd week: '.$this->Helps->compute_time($this->week2_hours)));
					
					$this->pdf->Ln(4);
					$this->pdf->SetX(17);
					$this->pdf->Write(0, ('3rd week: '.$this->Helps->compute_time($this->week3_hours)));
					
					$this->pdf->SetX(110);
					$this->pdf->Write(0, ('3rd week: '.$this->Helps->compute_time($this->week3_hours)));
					
					$this->pdf->Ln(4);
					$this->pdf->SetX(17);
					$this->pdf->Write(0, ('4th week: '.$this->Helps->compute_time($this->week4_hours)));
					
					$this->pdf->SetX(110);
					$this->pdf->Write(0, ('4th week: '.$this->Helps->compute_time($this->week4_hours)));
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
					
					// If Employee is Department Head
					$o = new Office_m();
					
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
					
					// Check if assistant
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
					
					
					$this->pdf->SetXY(17, 217);
					$this->pdf->Cell(73, 4, strtoupper($office['office_head']), '0', 0, 'C', FALSE);
					
					$this->pdf->SetX(110);
					$this->pdf->Cell(73, 4, strtoupper($office['office_head']), '0', 0, 'C', FALSE);
					
					$this->pdf->Ln(4);
					
					$this->pdf->SetX(17);
					$this->pdf->Cell(73, 4, $office['position'], '0', 0, 'C', FALSE);
					
					$this->pdf->SetX(110);
					$this->pdf->Cell(73, 4, $office['position'], '0', 0, 'C', FALSE);
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
				
				$this->pdf->Output('dtr/archives/'.$name['office_id']."_$employee_id.pdf", 'F'); 
				
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
			$this->pdf = new FPDI();
			
			$this->pdf->setFiles($multiple_dtr); 
			$this->pdf->concat();
			
			$this->pdf->Output('dtr/archives/'.$name['office_id'].".pdf", 'F'); 
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
	
	function set_dtr($row)
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
	}
	
	// --------------------------------------------------------------------
	
	function schedules()
	{
		$data['page_name'] = '<b>Schedules</b>';
		
		$data['msg'] = '';
		
		$s = new Schedule();
		
		$data['rows'] = $s->order_by('name')->get();
		
		$data['page'] = $this->uri->segment(3);
				
		$op = $this->input->post('op');
				
		$data['main_content'] = 'schedules';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function schedules_delete( $id = '', $page = '')
	{
		$s = new Schedule();
		
		$s->get_by_id( $id );
		
		$s->delete();
		
		$this->session->set_flashdata('msg', 'Schedule deleted!');
			
		redirect(base_url().'attendance/schedules/'.$page, 'refresh');
		
	}
	
	// --------------------------------------------------------------------
	
	function schedules_save( $id = '', $page = '' )
	{
		$data['page_name'] = '<b>Save Schedule</b>';
		$data['msg'] = '';
		
		$this->load->helper('options');
		
		$s = new Schedule();
		
		$data['sched'] = $s->get_by_id( $id );
		
		if($this->input->post('op'))
		{
			$all_time = array(
					'am_in_hour' 	=> $this->input->post('am_in_hour'),
					'am_in_min' 	=> $this->input->post('am_in_min'),
					
					'am_out_hour' 	=> $this->input->post('am_out_hour'),
					'am_out_min' 	=> $this->input->post('am_out_min'),
					
					'pm_in_hour' 	=> $this->input->post('pm_in_hour'),
					'pm_in_min' 	=> $this->input->post('pm_in_min'),
					
					'pm_out_hour' 	=> $this->input->post('pm_out_hour'),
					'pm_out_min' 	=> $this->input->post('pm_out_min')
					);
					
			
			$s->name 		= $this->input->post('name');
			$s->times 		= serialize($all_time);	
			
			$s->save();
			
			$this->session->set_flashdata('msg', 'Schedule saved!');
			
			redirect(base_url().'attendance/schedules/'.$page, 'refresh');
		}
		
		$times = $s->times;
		
		$times  = unserialize($times);
		
		
		$data['am_in_hour_selected'] 	= $times['am_in_hour'];
		$data['am_in_min_selected'] 	= $times['am_in_min'];
		
		$data['am_out_hour_selected'] 	= $times['am_out_hour'];
		$data['am_out_min_selected'] 	= $times['am_out_min'];
		
		$data['pm_in_hour_selected'] 	= $times['pm_in_hour'];
		$data['pm_in_min_selected'] 	= $times['pm_in_min'];
		
		$data['pm_out_hour_selected'] 	= $times['pm_out_hour'];
		$data['pm_out_min_selected'] 	= $times['pm_out_min'];
		
		$data['main_content'] = 'schedules_save';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function employee_schedule()
	{
		$data['page_name'] = '<b>Employee Schedules</b>';
		
		$data['msg'] = '';
		
		$this->session->unset_userdata('employees');
		
		$s = new schedule_detail();
		
		$data['rows'] = $s->order_by('name')->get();
		
		$data['page'] = $this->uri->segment(3);
						
		$op = $this->input->post('op');
				
		$data['main_content'] = 'employee_schedule';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function employee_schedule_save( $id = '', $page = '' )
	{
		$data['page_name'] = '<b>Save Employee Schedule</b>';
		$data['msg'] = '';
		
		$data['selected'] = $this->session->userdata('office_id');
		
		if ($id != '')
		{
			$sd = new Schedule_detail();
			$sd->get_by_id( $id );
			
			$data['selected'] = $sd->office_id;
		}
		
		
		
		//Use for office listbox
		$data['options'] = $this->options->office_options(TRUE);
		
		
		
		$this->load->helper('options');
		
		$sd = new Schedule_detail();
		
		$data['sched'] = $sd->get_by_id( $id );
		
		$dates = unserialize($sd->dates);
		
		if ( $dates == '')
		{
			$dates = array(
						'year' 			=> date('Y'),
						'period_from' 	=> 1,
						'period_to'		=> date('d'),
						'month' 		=> date('m'),
						); 
		}
		
		$db_employees = unserialize($sd->employees);
		
		if( ! $this->input->post('op'))
		{
			// if the database has value on it add the value from database to session
			if (is_array($db_employees))
			{
				if (! is_array($this->session->userdata('employees')))
				{
					$this->session->set_userdata('employees', array());
				}
				
				$employees = array_merge($this->session->userdata('employees'), $db_employees);
				
				$this->session->set_userdata('employees', $employees);
			}
		}
		
		if($this->input->post('op'))
		{
			$employees = $this->session->userdata('employees');
			
			$month_year = $this->input->post('year').'-'.$this->input->post('month');
			
			$between_from = $month_year.'-'.$this->input->post('period_from');
			$between_to   = $month_year.'-'.$this->input->post('period_to');
			
			$dates = array(
						'year' 			=> $this->input->post('year'),
						'period_from' 	=> $this->input->post('period_from'),
						'period_to'		=> $this->input->post('period_to'),
						'month' 		=> $this->input->post('month')
						); 
			
			$days = $this->Helps->get_days_in_between($between_from, $between_to);
			
			
			if( ! $this->input->post('op'))
			{
				if (is_array($db_employees))
				{
					$employees = array_merge($employees, $db_employees);
				}
			}
			
			$employees = array_unique($employees);
			
			$sd->name 			= $this->input->post('name');
			$sd->employees 		= serialize($employees);
			$sd->dates 			= serialize($dates);	
			$sd->schedule_id 	= $this->input->post('schedule_id');
			$sd->office_id 		= $this->input->post('office_id');
			
			$sd->save();
			
			$this->session->set_flashdata('msg', 'Schedule saved!');
			
			// Get the schedule
			$s = new Schedule();
			
			$s->get_by_id($this->input->post('schedule_id'));
			
			$times = unserialize($s->times);
			
			// Check if 2 logs or 4 logs
			
			if ( $times['am_in_hour'] != '' && $times['am_out_hour'] != '' && $times['pm_in_hour'] != '' && $times['pm_out_hour'] != '')
			{				
				$sched_data['hour_from'] = '';
				
				$sched_data['hour_to'] = '';
				
				
				
				$sched_data['am_in'] = $times['am_in_hour'].':'.$times['am_in_min'];
				
				$sched_data['am_out'] = $times['am_out_hour'].':'.$times['am_out_min'];
				
				$sched_data['pm_in'] = $times['pm_in_hour'].':'.$times['pm_in_min'];
				
				$sched_data['pm_out'] = $times['pm_out_hour'].':'.$times['pm_out_min'];
				
				$shift_id = 3;
				$shift_type = 3;
				
				
			}
			else
			{
				//echo '2 times';	
				
				// IN
				if ( $times['am_in_hour'] != '' )
				{
					$sched_data['hour_from'] = $times['am_in_hour'].':'.$times['am_in_min'];
				}
				else if ( $times['pm_in_hour'] != '' )
				{
					$sched_data['hour_from'] = $times['pm_in_hour'].':'.$times['pm_in_min'];
				}
				
				// OUT
				if ( $times['am_out_hour'] != '' )
				{
					$sched_data['hour_to'] = $times['am_out_hour'].':'.$times['am_out_min'];
				}
				else if ( $times['pm_out_hour'] != '' )
				{
					$sched_data['hour_to'] = $times['pm_out_hour'].':'.$times['pm_out_min'];
				}
				
				
				
				$sched_data['am_in'] = '';
				
				$sched_data['am_out'] = '';
				
				$sched_data['pm_in'] = '';
				
				$sched_data['pm_out'] = '';
				
				$shift_id = 2;
				$shift_type = 2;
				
				
				// Check if 24 hrs
				
				if ( $sched_data['hour_from'] == $sched_data['hour_to'] )
				{
					$shift_id 	= 4;
					$shift_type = 4;
				}
				
			}
			
			
			foreach ($days as $day)
			{
				//echo $day."<br>";
				
				$sched_data['date'] = $day;
				
				$oe = new Employee_m();
				
				foreach ( $employees as $employee)
				{
					// Change the shift ID
					$oe->get_by_employee_id( $employee );
					
					$oe->shift_id = $shift_id;
					$oe->shift_type = $shift_type;
					
					$oe->save();
					
					
					// Check if there is schedule for this date
					
					$sched_data['employee_id'] = $employee;
					
					$is_schedule_exists = $this->Schedule_employees->is_schedule_exists($employee, $day);
					
					// Update
					if ( $is_schedule_exists == TRUE )
					{
						$this->Schedule_employees->update( $sched_data, $day, $employee);
					}
					else // Insert
					{
						$this->Schedule_employees->insert( $sched_data );
					}
				}
				
				
			}
			
			//Unset the session
			//$employees = array();
			//$this->session->set_userdata($employees);
			$this->session->unset_userdata('employees');
			
			//redirect(base_url().'settings_manage/schedules/'.$page, 'refresh');
			$this->session->set_flashdata('msg', 'Schedule saved!');
			$data['msg'] = 'Employee Schedule has been saved!';
		}
		
		
		// Months
		$data['month_options'] 			= $this->options->month_options();
		$data['month_selected'] 		= $dates['month'];
		
		//print_r($dates);
		
		// Period from
		$data['days_options'] 			= $this->options->days_options();
		$data['period_from_selected'] 	= $dates['period_from'];
		
		// Period to
		$data['days_options'] 			= $this->options->days_options();
		$data['period_to_selected'] 	= $dates['period_to'];
		
		$data['year_options'] 			= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 			= $dates['year'];
				
		$data['main_content'] = 'employee_schedule_save';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function employee_schedule_view_employees($id = '')
	{
		$s = new Schedule_detail();
		
		$s->get_by_id( $id );
		
		$data['page_name'] = '<b>Employee Schedule ('.$s->name.')</b>';
		
		$data['msg'] = '';
		
		$employees = unserialize($s->employees);
		
		foreach( $employees as $key => $val)
		{
			if($val == 0 ) 
			{
				unset($employees[$key]);
			}
		} 
		
		$data['employees'] = $employees;
				
		$data['main_content'] = 'employee_schedule_view_employees';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function employee_schedule_delete( $id = '', $page = '')
	{
		
		$s = new Schedule_detail();
		
		$s->get_by_id( $id );
		
		$s->delete();
		
		$this->session->set_flashdata('msg', 'Employee Schedule deleted!');
			
		redirect(base_url().'attendance/employee_schedule/'.$page, 'refresh');
		
	}
	
	// --------------------------------------------------------------------
	
	function jo()
	{
		$data['page_name'] = '<b>Contractual / Job Order</b>';
		$data['msg'] = '';
		
		$data['month'] = date('m');
		$data['year'] = date('Y');
		
		// Months
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
				
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		if(isset($_POST['op']) )
		{
			$data['month'] 	= $this->input->post('month');
			$data['year'] 	= $this->input->post('year');
			
			$data['month_selected'] = $this->input->post('month');
			$data['year_selected'] 	= $this->input->post('year');
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
				
		$data['rows'] = $this->Dtr->double_entries(date('m'), date('Y'));
		
		// ==========================
		
		$rows = $data['rows'];
		
		foreach($rows as $row)
		{
		
			$employee_id = $row['employee_id'];
			
			$log_date 	= $row['log_date'];
						
			$logs = $this->Dtr->double_entries_employee($row['employee_id'], $row['log_date']);
			
			foreach( $logs as $log)
			{
				// If blank delete the entry in dtr
				if (	$log['am_login'] == '' and 
						$log['am_logout'] == '' and 
						$log['pm_login'] == '' and 
						$log['pm_logout'] == '')
				{
					$this->Dtr->delete_by_id($log['id']);
				}
			}
		}
		
		$data['rows'] = $this->Dtr->double_entries(date('m'), date('Y'));
		
		// ============================
		
		if($this->input->post('op'))
		{
			$data['month_selected'] 	= $this->input->post('month');
			$data['year_selected'] 		= $this->input->post('year');
			$data['rows'] = $this->Dtr->double_entries(
										$this->input->post('month'), 
										$this->input->post('year'));	
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
			
			$this->start_date = 1;
			
			if ($this->period_from != '1')
			{
				$this->start_date = $this->period_from; // Start of viewing DTR
				
				$this->period_from = '1'; // We will still use the first day
			}
			
			//$this->start_date = $this->period_from;
		}
	}
	
	// --------------------------------------------------------------------
	
	function regular_hours()
	{
		// If regular working hours
		if ( $this->shift_type == 1 )
		{
			$shift_time = $this->Shift->shift_times($this->shift_type, 1);
		
			$this->time_a = $shift_time['time_a'];
			$this->time_b = $shift_time['time_b'];
			$this->time_c = $shift_time['time_c'];
			$this->time_d = $shift_time['time_d'];
		}
		
		
		// If special time get the time from schedule_employees
		if ( $this->shift_type == 3 )
		{
			//$se = new Schedule_employees();
			$se = $this->Schedule_employees->get_schedule($this->employee_id );
			
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
			
			// Use for muslim added 2.8.2013 3.29pm
			if ($this->friday_exempted == 'yes' and $this->sat_or_sun == 'Friday')
			{
				//$this->time_a = $shift_time['time_a'];
				$this->time_b = '10:00';
				$this->time_c = '14:00';
				//$this->time_d = $shift_time['time_d'];
			}
			
			$this->Helps->employee_id = $this->employee_id; // added 09-07-2011
				
			//am login and pm login check if late
			$late = $this->Helps->check_late($this->am_login, $this->time_a, $this->pm_login, $this->time_c);
			
					
			//If there is no late
			//Check if the date has tardiness
			//that entered during dtr viewing
			//(use if the tardiness has been updated 
			//with the wrong dtr record
			//for ex: there is no out so it will generate 
			//a large amount of tardiness
			$this->Tardiness->delete_tardiness($this->employee_id, $this->log_date, $this->Helps->am_login);
			$this->Tardiness->delete_tardiness($this->employee_id, $this->log_date, $this->Helps->pm_login);
			
			//echo $this->time_c;
			//echo $this->sat_or_sun;
			
			//exit;
			
			
			// Am logout check if undertime
			$undertime = $this->Helps->check_undertime($this->am_logout, $this->time_b, $this->pm_logout, $this->time_d);
			
			//$this->time_a = $shift_time['time_a'];
			//$this->time_b = $shift_time['time_b'];
			//$this->time_c = $shift_time['time_c'];
			//$this->time_d = $shift_time['time_d'];
			
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
				
				// add to late count
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
				
				$this->Tardiness->check_tardiness($this->employee_id, $this->log_date, $logType = 4, $number_seconds);
				
				
				
				// add this lines 12.14.2012 8.37am	
				// this block of codes dont compute the undertime in PM if
				// the employee has no logs in PM if the holiday is PM half day
				
				if (
					$this->Holiday->is_holiday($this->log_date) and 
					$this->Holiday->half_day == TRUE and
					$this->Holiday->am_pm == 'pm'
					)
				{

					//$this->pm_logout = '';
				}
				else
				{
					// Add to undertime count
					$this->undertime_count += 1;
					
					$this->undertime_final += $number_seconds;
				}	
				// end add 12.14.2012 8.37am
				
				
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
			
			
			
			// Updates 7.3.2012
			if ($this->am_login == '' && $this->am_logout == 'Official Business' && 
				$this->pm_login == 'Official Business' && $this->pm_logout == 'Official Business')
			{	
				$this->Tardiness->check_tardiness($this->employee_id, $this->log_date, $logType = 1, $number_seconds);
				
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
				
			// If there is a undertime in am_logout
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
					
			// Undertime counter (minutes or hours late)
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
		
		$v_abs = $this->Leave_conversion_table->compute_hour_minute($this->total_tardiness);
		
		// Deductions to leave credit but not final ============================
		// update 02122012 agency can choose if they want the auto deduct or not
		
		$active = 0;
		
		$tardy_autodeduct = $this->Settings->get_selected_field('tardy_autodeduct');
		
		if ($tardy_autodeduct == 'yes')
		{
			$active = 1;
		}
		
		// If not zero undertime
		if ($particulars != 'UT-0-0-0')
		{
			
			
			if ($is_entry_exists == TRUE)
			{
				// edit
				$this->Leave_card->update_entry($this->employee_id, $particulars, $v_abs, $action_take, $last_day, $active);
			}
			else
			{
				// insert
				$this->Leave_card->insert_entry($this->employee_id, $particulars, $v_abs, $action_take, $last_day, $active);
				
			}
		}
		else
		{
			// If no late or undertime
			//echo $particulars.'haha';
			//exit;
			$this->Leave_card->delete_undertime($this->employee_id, $last_day);
		}
	}
	
	// --------------------------------------------------------------------
	
	function view_absences()
	{
		$data['page_name'] 			= '<b>List of Absences</b>';
		$data['msg'] = '';
		
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= $this->session->userdata('office_id');
		
		$data['date'] 				= date("Y-m-d");
		
		$data['rows']				= $this->Dtr->get_absences(
													$this->session->userdata('office_id'), 
													$data['date']
													);
		
		if($this->input->post('op'))
		{
			$data['date'] 			= $this->input->post('date2');
			
			$data['selected'] 		= $this->input->post('office_id');
			
			$data['rows'] 			= $this->Dtr->get_absences(
													$this->input->post('office_id'), 
													$data['date']
													);
		}
				
		$data['main_content'] = 'view_absences';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function view_late()
	{
		$data['page_name'] = '<b>View Late/Undertime</b>';
		$data['msg'] = '';
		
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= $this->session->userdata('office_id');
		
		$data['date'] = date("Y-m-d");
	  
		$is_log_pm = FALSE;

		$data['rows'] = $this->Dtr->get_late_employee(
											$this->session->userdata('office_id'), 
											$data['date'], 
											$is_log_pm
											);
		
		if($this->input->post('op'))
		{
			$data['date'] 		= $this->input->post('date2');
			
			$data['selected'] 	= $this->input->post('office_id');
			
			$data['rows'] = $this->Dtr->get_late_employee($this->input->post('office_id'), $data['date'], $is_log_pm);
		}
				
		$data['main_content'] = 'view_late';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function view_ob()
	{
		$data['page_name'] = '<b>View Official Business</b>';
		$data['msg'] = '';
		
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= $this->session->userdata('office_id');
		
		$data['date'] 				= date("Y-m-d");
	  
		$is_log_pm 					= FALSE;
		
		$this->Dtr->fields 			= array('employee_id', 'manual_log_id');
		
		$data['rows'] 				= $this->Dtr->get_ob_employee($this->session->userdata('office_id'), $data['date']);
		
		if($this->input->post('op'))
		{
			$data['date'] 			= $this->input->post('date2');
			
			$data['selected'] 		= $this->input->post('office_id');
			
			$data['rows'] 			= $this->Dtr->get_ob_employee($this->input->post('office_id'), $data['date']);
		}
		
		$data['main_content'] = 'view_ob';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function view_tardiness()
	{
		$data['page_name'] 			= '<b>Tardiness</b>';
		$data['msg'] 				= '';
		
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= $this->session->userdata('office_id');
		
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		$data['date'] 				= date("Y-m-d");

		$data['month1'] 			= date('m');
		$data['year1'] 				= date('Y');
		
		$data['rows'] 				=  $this->Tardiness->get_employees_with_tardy(
																	$data['month1'], 
																	$data['year1'], 
																	$this->session->userdata('office_id')
																	);
		
		if(isset($_POST['month']))
		{
			$data['month1'] 		= $this->input->post('month');
			$data['year1'] 			= $this->input->post('year');
			
			$data['rows']			= $this->Tardiness->get_employees_with_tardy(
																	$data['month1'], 
																	$data['year1'], 
																	$this->input->post('office_id')
																	);
																		
			$data['selected'] 		= $this->input->post('office_id');	
			
			$data['month_selected'] = $this->input->post('month');	
			
			$data['year_selected'] 	= $this->input->post('year');								
		}
		
		if ($this->input->post('print') || $this->input->post('print2'))
		{
			// Create the report
			modules::run("reports/report_tardiness");// Although there is no parameter for the module call
													 // We can use the POST variable ready available.
			//Pop up window open here.
			?>
			<script src="<?php echo base_url();?>js/function.js"></script>
            <script>openBrWindow('<?php echo base_url()."dtr/reports/report_tardiness.pdf";?>','','scrollbars=yes,width=800,height=700')</script>
			<?php
		}
				
		$data['main_content'] = 'view_tardiness';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function view_ten_tardiness()
	{
		$data['page_name'] = '<b>View 10x Tardiness</b>';
		
		$data['msg'] = '';
		
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= $this->session->userdata('office_id');
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		$data['date'] = date("Y-m-d");

		$data['month1'] = date('m');
		$data['month2'] = date('m');
		$data['year1'] 	= date('Y');
		
		$data['m1'] = 'Jan';
		$data['m2'] = 'Feb';
		$data['m3'] = 'March';
		$data['m4'] = 'Apr';
		$data['m5'] = 'May';
		$data['m6'] = 'Jun';
		
		$data['mo1'] = '01';
		$data['mo2'] = '02';
		$data['mo3'] = '03';
		$data['mo4'] = '04';
		$data['mo5'] = '05';
		$data['mo6'] = '06';
		
		$all_tardiness = $this->input->post('all_tardiness');
		
		if ($all_tardiness)
		{
			$this->Tardiness->all_tardiness = TRUE;
		}
		
		$data['office_id'] = $this->session->userdata('office_id');
		
		if ($this->input->post('op'))
		{
			$data['year_selected'] 	= $this->input->post('year');
			
			// Just implement to set the selected month dropdown
			$this->form_validation->set_rules('month1', 'Month');
			$this->form_validation->set_rules('month2', 'Month');
			$this->form_validation->run();
		}
		
		if($this->input->post('month1'))
		{
			$data['month1'] 	= $this->input->post('month1');
			$data['month2'] 	= $this->input->post('month2');
			$data['year1'] 		= $this->input->post('year');
			$data['office_id'] 	= $this->input->post('office_id');
			
			if ($data['month1'] == '01' && $data['month2'] == '06')
			{
				$data['m1'] = 'Jan';
				$data['m2'] = 'Feb';
				$data['m3'] = 'March';
				$data['m4'] = 'Apr';
				$data['m5'] = 'May';
				$data['m6'] = 'Jun';
				
				$data['mo1'] = '01';
				$data['mo2'] = '02';
				$data['mo3'] = '03';
				$data['mo4'] = '04';
				$data['mo5'] = '05';
				$data['mo6'] = '06';
				
				$this->Tardiness->sem = 1;
				
				$data['employees'] 	=  $this->Tardiness->get_employees_ten_tardy(
																		 $data['month1'], 
																		 $data['month2'], 
																		 $data['year1']
																		 );
		
				$data['offices'] 	=  $this->Tardiness->offices_tardy;

				//print_r($data['offices']);
			}
			
			if ($data['month1'] == '07' && $data['month2'] == '12')
			{
				$data['m1'] = 'Jul';
				$data['m2'] = 'Aug';
				$data['m3'] = 'Sep';
				$data['m4'] = 'Oct';
				$data['m5'] = 'Nov';
				$data['m6'] = 'Dec';
				
				$data['mo1'] = '07';
				$data['mo2'] = '08';
				$data['mo3'] = '09';
				$data['mo4'] = '10';
				$data['mo5'] = '11';
				$data['mo6'] = '12';
				
				
				
				// We need to get the data from first sem first
				// so we need to change the month
				$data['employees'] 	=  $this->Tardiness->get_employees_ten_tardy(
																		 '01', 
																		 '06', 
																		 $data['year1']
																		 );
				// Employees with 2 10 times tardy from first sem
				$tardy_employees = $this->Tardiness->employees;		
												 
				$this->Tardiness->sem = 2;
																 
				$data['employees'] 	=  $this->Tardiness->get_employees_ten_tardy(
																		 $data['month1'], 
																		 $data['month2'], 
																		 $data['year1']
																		 );	
																		 
				// Employees with 2 10 times tardy from second sem												 
				$tardy_employees2 = $this->Tardiness->employees;
							
				foreach ($tardy_employees as $tardy_employee)
				{
					if (in_array($tardy_employee, $tardy_employees2))
					{
						//echo $tardy_employee.'<br>';
						
						$second_offenders[] = $tardy_employee;
					}
					
				}
				
				if (isset($second_offenders))
				{
					echo modules::run("reports/ten_tardiness_second", $second_offenders);
				
					// Pop up window open here.
					?>
					<script src="<?php echo base_url();?>js/function.js"></script>
					<script>openBrWindow('<?php echo base_url()."dtr/reports/ten_tardiness_second.pdf";?>','','scrollbars=yes,width=800,height=700')</script>
					<?php
				}
										 												 
				
				
				$data['offices'] 	=  $this->Tardiness->offices_tardy;
			}
			
			
		}

		// Print memo
		if ($this->input->post('memo'))
		{
			$offices = $this->input->post('offices');
			
			$year1 = $this->input->post('year');
			
			if ($this->input->post('month1') == '01' && $this->input->post('month2') == '06')
			{
				$sem = 1;
			}
			
			if ($this->input->post('month1') == '07' && $this->input->post('month2') == '12')
			{
				$sem = 2;
			}
			
			
			if($offices)
			{
				
				//echo 'cool';
				//exit;

				// Create the report
				modules::run("reports/ten_tardiness", $sem);
													
				// Pop up window open here.
				?>
				<script src="<?php echo base_url();?>js/function.js"></script>
				<script>openBrWindow('<?php echo base_url()."dtr/reports/ten_tardiness.pdf";?>','','scrollbars=yes,width=800,height=700')</script>
				<?php
			}
		}
		
		// All offices tardiness
		if ($this->input->post('print') || $this->input->post('print2'))
		{
			// Create the report
			modules::run("reports/all_office_tardiness");
			
			// Pop up window open here.
			?>
			<script src="<?php echo base_url();?>js/function.js"></script>
			<script>openBrWindow('<?php echo base_url()."dtr/reports/all_office_tardiness.pdf";?>','','scrollbars=yes,width=800,height=700')</script>
			<?php
		}
			
		$data['main_content'] = 'view_ten_tardiness';
		
		$this->load->view('includes/template', $data);
		
	}
	
	
}

/* End of file attendance.php */
/* Location: ./application/modules/attendance_manage/controllers/attendance.php */