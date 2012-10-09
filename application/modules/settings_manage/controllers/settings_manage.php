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
class Settings_Manage extends MX_Controller {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		//$this->output->enable_profiler(TRUE);
		
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    }  
	
	// --------------------------------------------------------------------
	
	function salary_grade()
	{
		
		$data['page_name'] = '<b>Salary Grade (Authorized)</b>';
		$data['msg'] = '';
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		if($this->input->post('year'))
		{
			$data['year_selected'] 	= $this->input->post('year');
			
			// Check if the year exists
			$s = new Salary_grade_m();
			
			$s->get_by_year($data['year_selected']);
			
			if ( ! $s->exists() )
			{
				$i = 1;
				
				while($i != 31)
				{
					$s = new Salary_grade_m();
					$s->sg 					= $i;
					$s->year 				= $data['year_selected'];
					$s->salary_grade_type 	= ($this->input->post('salary_grade_type')) 
											? $this->input->post('salary_grade_type') 
											: '';
					$s->save();
					
					$i ++;
				}				
				
			}
		}
		
		$data['hospital'] = '';
		
		if ( $this->Settings->get_selected_field('lgu_code') == 'marinduque_province' )
		{
			$data['hospital'] = 'yes';
		}
		
		$data['rows'] = $this->Salary_grade->get_salary_grade($data['year_selected'], $this->input->post('salary_grade_type'));
		
		$data['main_content'] = 'salary_grade';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function salary_grade_proposed()
	{
		
		$data['page_name'] = '<b>Salary Grade (Proposed)</b>';
		$data['msg'] = '';
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		if($this->input->post('year'))
		{
			$data['year_selected'] 	= $this->input->post('year');
			
			// Check if the year exists
			$s = new Salary_grade_proposed_m();
			
			$s->get_by_year($data['year_selected']);
			
			if ( ! $s->exists() )
			{
				$i = 1;
				
				while($i != 31)
				{
					$s = new Salary_grade_proposed_m();
					$s->sg 					= $i;
					$s->year 				= $data['year_selected'];
					$s->salary_grade_type 	= ($this->input->post('salary_grade_type')) 
											? $this->input->post('salary_grade_type') 
											: '';
					$s->save();
					
					$i ++;
				}				
				
			}
		}
		
		$data['hospital'] = '';
		
		if ( $this->Settings->get_selected_field('lgu_code') == 'marinduque_province' )
		{
			$data['hospital'] = 'yes';
		}
		
		$s = new Salary_grade_proposed_m();
		
		$data['rows'] = $s->get_salary_grade($data['year_selected'], $this->input->post('salary_grade_type'));
		
		$data['main_content'] = 'salary_grade_proposed';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function holiday($delete_id = '')
	{
		
		$data['page_name'] = '<b>Holiday</b>';
		$data['msg'] = '';
		
		//Months
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
		
		//day
		$data['days_options'] 		= $this->options->days_options();
		$data['days_selected'] 		= date('d');
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		if ($delete_id)
		{
			$this->Holiday->delete_holiday($delete_id);
		}
		
		$data['rows'] 				= $this->Holiday->holiday_list($data['year_selected']);
		
		if($this->input->post('op'))
		{
			if ($this->input->post('add_date'))
			{
				if($this->input->post('description') != "" && 
					checkdate($this->input->post('month'), $this->input->post('day'), $this->input->post('year')))
				{	
					$info = array(
							'date' 			=> $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day'),
							'description' 	=> $this->input->post('description'),
							);
					
					$this->Holiday->add_holiday($info);	
				}
			}
			
			$data['year_selected'] 		= $this->input->post('year_select');
			$data['rows'] 				= $this->Holiday->holiday_list($this->input->post('year_select'));
		}
				
		$data['main_content'] = 'holiday';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function schedule()
	{
		$data['page_name'] = '<b>Employee Schedule</b>';
		$data['msg'] = '';
		
		
		$times = array(
					'am_in' => '06:00',
					'am_out' => '12:00',
					'pm_in' => '15:00',
					'pm_out' => '17:00'
					);
					
		echo serialize($times);		
		
		$s = new Schedule();
		
		$s->get_by_id(2);
		
		$s->schedule_detail->get_iterated();
		
		foreach ($s->schedule_detail as $sd)
		{
			//echo $sd->name . '<br />';
		}
		
		//$a = new Schedule_detail();
		
		
		$dtr2 = $this->input->post('dtr2');
		
		   
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
			echo modules::run("dtr_manage/dtr");
			?>
			<script src="<?php echo base_url();?>js/function.js"></script>
			<script>openBrWindow('<?php echo base_url()."dtr/archives/".$office_id.".pdf";?>','','scrollbars=yes,width=800,height=700')</script>
			<?php
		}
		
		
		$data['options'] 					= $this->options->office_options();
		$data['selected'] 					= $this->session->userdata('office_id');
		
		$data['date'] 						= date("Y-m-d");
		$data['date2'] 						= date("Y-m-d");
		
		$op = $this->input->post('op');
		
		if ($op == 1)
		{
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
			
			$data['rows'] = $this->Schedule_employees->get_office_schedule(
										 $this->input->post('office_id'), 
										 $this->input->post('date'), 
										 $this->input->post('date2'), 
										 $this->input->post('employee_id')
										 );
			
			if($this->input->post('employee_id') == '')
			{
				$_POST['employee_id'] = 'Employee ID';
			}
		
			$data['date'] = $this->input->post('date');
			$data['date2'] = $this->input->post('date2');
		}
		else
		{
			$data['rows'] = $this->Schedule_employees->get_office_schedule($this->session->userdata('office_id'), $data['date'], $data['date']);
			
		}
		
		$total_employee = $this->Employee->num_rows;
		
		if(!$this->input->post('employee_id'))
		{
			$_POST['employee_id'] = 'Employee ID';
		}
				
		$data['main_content'] = 'schedule';
		
		$this->load->view('includes/template', $data);
		
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
			
		redirect(base_url().'settings_manage/schedules/'.$page, 'refresh');
		
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
			
			redirect(base_url().'settings_manage/schedules/'.$page, 'refresh');
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
		
		$s = new schedule_detail();
		
		$data['rows'] = $s->order_by('name')->get();
		
		$data['page'] = $this->uri->segment(3);
		
		//$data['dates'] = $s->dates;
				
		$op = $this->input->post('op');
				
		$data['main_content'] = 'employee_schedule';
		
		$this->load->view('includes/template', $data);
		
	}
	
	
	function employee_sched($employee_id = '')
	{
		$data['page_name'] = '<b>Employee Schedule</b>';
		$data['msg'] = '';
		
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= $this->session->userdata('office_id');
	
		//Months
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
		
		//Days
		$data['days_options'] 		= $this->options->days_options();
		$data['days_selected'] 		= date('d');
		
		$data['year_options'] 		= $this->options->year_options(2010, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
	
		
		// Get employee info
		$this->Employee->fields = array('id', 'lname', 'fname', 'mname');
		
		$data['name'] = $this->Employee->get_employee_info($employee_id);
				
		$data['main_content'] = 'employee_sched';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function employee_schedule_save( $id = '', $page = '' )
	{
		$data['page_name'] = '<b>Save Employee Schedule</b>';
		$data['msg'] = '';
		
		$data['selected'] = $this->session->userdata('office_id');
		$data['selected'] = 0;
		
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
			
			$sd->name 			= $this->input->post('name');
			$sd->employees 		= serialize($employees);	
			$sd->dates 			= serialize($dates);	
			$sd->schedule_id 	= $this->input->post('schedule_id');
			
			$sd->save();
			
			$this->session->set_flashdata('msg', 'Schedule saved!');
			
			// Get the schedule
			$s = new Schedule();
			
			$s->get_by_id($this->input->post('schedule_id'));
			
			$times = unserialize($s->times);
			
			// Check if 2 logs or 4 logs
			
			if ( $times['am_in_hour'] != '' && $times['am_out_hour'] != '' && $times['pm_in_hour'] != '' && $times['pm_out_hour'] != '')
			{
				//echo '4 times';
				
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
		
		//print_r($data['employees']);
		
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
			
		redirect(base_url().'settings_manage/employee_schedule/'.$page, 'refresh');
		
	}
	
	function audit_trail($delete_id = '')
	{
		
		$data['page_name'] = '<b>Audit Trail</b>';
		$data['msg'] = '';
		
		if ($delete_id)
		{	
			$this->Logs->delete_logs($delete_id);
		}
		
		if ($this->input->post('remove_selected') && $this->input->post('log'))
		{	
			$logs = $this->input->post('log');
			
			foreach ($logs as $log)
			{
				$this->Logs->delete_logs($log);
			}
		}
		
		if ($this->input->post('remove_all'))
		{	
			$this->Logs->delete_all_logs();
		}
		
		// Use for office listbox
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= $this->session->userdata('office_id');
	
		$office_id					= $this->session->userdata('office_id');
	
		if ($this->input->post('op'))
		{
			$data['selected'] 	= $this->input->post('office_id');
			$office_id 			= $this->input->post('office_id');
			
			if ($this->input->post('username'))
			{
				$this->Logs->username = $this->input->post('username');
			}
			if ($this->input->post('module'))
			{
				$this->Logs->module = $this->input->post('module');
			}
			if ($this->input->post('date1') and $this->input->post('date2'))
			{
				$this->Logs->date1 = $this->input->post('date1');
				$this->Logs->date2 = $this->input->post('date2');
			}
			
		}
		
		$this->load->library('pagination');
				
		$data['logs'] = $this->Logs->count_logs($office_id);
		
		$config['base_url'] = base_url().'settings_manage/audit_trail';
		$config['total_rows'] = $this->Logs->num_rows;
	    $config['per_page'] = '15';
	    $config['full_tag_open'] = '<p>';
	    $config['full_tag_close'] = '</p>';
				
		$this->pagination->initialize($config);
		
		$data['logs'] = $this->Logs->get_logs( $office_id, $config['per_page'], $this->uri->segment(3));
				
		$this->pagination->initialize($config);
				
		$data['main_content'] = 'audit_trail';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function general_settings()
	{
		
		$data['page_name'] = '<b>Settings</b>';
		$data['msg'] = '';
		
		if ($this->input->post('op'))
		{
			// We get all the POST data. $key is the field name
			// which is the name of settings in database table.
			// We update the settings table to a new value($val)
			foreach ($_POST as $key => $val)
			{
				$this->Settings->update_settings($key, $val);
			}
			
			$data['msg'] = 'Settings has been saved!';
		}
		
		$data['settings'] = $this->Settings->get_settings();
				
		$data['main_content'] = 'general_settings';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function backup()
	{
		
		$data['page_name'] = '<b>Restore/ Back up</b>';
		$data['msg'] = '';
				
		$data['main_content'] = 'backup';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function offline_update()
	{
		
		$data['page_name'] = '<b>Offline Update </b>';
		$data['msg'] = '';
				
		$data['main_content'] = 'offline_update';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function backup_database()
	{
		
		
		// Load the DB utility class
		$this->load->dbutil();
		
		// Backup your entire database and assign it to a variable
		$backup =& $this->dbutil->backup(); 
		
		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file('/dtr/'.date('Y-m-d').'.zip', $backup); 
		
		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download(date('Y-m-d').'.zip', $backup); 
	}
	
	
}	