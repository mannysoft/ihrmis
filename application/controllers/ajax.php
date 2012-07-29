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
 * iHRMIS Ajax Class
 *
 * This class use for migrating database.
 *
 * @package		iHRMIS
 * @subpackage	Controllers
 * @category	Utilities
 * @author		Manolito Isles
 * @link		http://charliesoft.net/hrmis/user_guide/controllers/ajax.html
 */

class Ajax extends MX_Controller {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
				
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		//$this->output->enable_profiler(TRUE);
    }  
	
	function add_earning($employee_id = '', $month = '', $day = '', $year = '', $v_earned = 0, $s_earned = 0)
	{		
		$data = array(
					"employee_id"	=> $employee_id,
					"period" 		=> $year.'-'.$month.'-'.$day,
					"v_earned" 		=> $v_earned, 
					"s_earned" 		=> $v_earned,
					"date"			=> $year.'-'.$month.'-'.$day
					);
							
		$this->Leave_card->add_leave_card($data);
		
		echo '<b>Added!</b>';
		
		//echo $employee_id.$month.$day.$year.$v_earned.$s_earned;
	}
	
	// --------------------------------------------------------------------
	
	function cancel_deduct_undertime($month, $year)
	{
		$last_day = $this->Helps->get_last_day($month, $year);
	
		$last_day = $year.'-'.$month.'-'.$last_day;
		
		$this->Leave_card->set_enabled($last_day, 0);
		
		echo '<b>Done!</b>';
	}
	
	// --------------------------------------------------------------------
	
	function connect_machine($ip, $com_no = 0, $machine_no = 0, $delete_data = '')
	{
		// Change the IP address of t4_connect/logs/ip.txt
		$this->Stand_alone->change_ip('t4_connect/logs/ip.txt', $ip);
		
		// If the checkbox for delete logs from 
		// machine is check then delete the logs from machine
		if ($delete_data)
		{
			$this->Stand_alone->change_delete_status('yes');
			
			//to be implement after a long period of testing
		}
		
		
		if ($com_no != 0)
		{
			// Change method
			$this->Stand_alone->change_method('t4_connect/logs/method.txt', 'com');	
			
		}
		else
		{
			// change method
			$this->Stand_alone->change_method('t4_connect/logs/method.txt', 'net');	
		}
		 
		
		//Sleep for 2 seconds
		sleep(2);
		
		//Excute the exe file
		exec("t4_connect\\logs.exe");
		
		//Sleep for 2 seconds
		sleep(2);
		
		//Read the message file
		$msg = file_get_contents('t4_connect/logs/msg.txt', true);
		
		//print_r($msg);
		
		//$msg = 'Success';
		
		//echo $ip;
		
		//$msg = 'Failed';
		if (trim($msg) == 'Success')
		{
			//Read the logs file and put to db
			$TempTXT = "t4_connect/logs/".date('Y-m-d').'.txt';
			//echo $TempTXT;
			//$TempTXT = "t4_connect/logs/".'2010-01-17.txt';
			
			if (!file_exists($TempTXT))
			{
				$TempTXT = 't4_connect/logs/temp.txt';
			}
			
			if ($fd = fopen ($TempTXT, "r")) 
			{
				while (!feof ($fd)) 
				{ 
					$lines[] = fgets($fd, 4096); 
				}
			  fclose ($fd);
			}
			
			sort($lines);
			
			$log_type 	 = '';
			$ampm 	  	 = '';
			$employee_id = '';
			$log_date	 = '';
			
			foreach($lines as $line)
			{
				//echo $line.'<br>';
				
				
				//if (count(split(' ', $line)) != 4)
				if (count(explode(' ', $line)) != 4)
				{
					$employee_id = '';
					$date = '' ;
					$time = '';
					$inout = '';
				}
				else
				{
					//list($employee_id, $date, $time, $inout)  = split(' ', $line);
					list($employee_id, $date, $time, $inout)  = explode(' ', $line);
				}
				
				
				
				
				$time = date('H:i', strtotime($time));
				
				//0 = in , 1 = out
				
				// get the office id of an employee
				$office_id = $this->Employee->get_single_field('office_id', $employee_id);
				
				
				
				//INSERT to table
				$info = array(
							"employee_id" 	=> $employee_id,
							"office_id"		=> $office_id,
							"log_date" 		=> $date,
							"logs" 			=> $time,
							"log_type" 		=> $inout,
							"date_extract" 	=> date('Y-m-d')
							);
			
				$id = $this->Dtr_temp->insert_dtr_temp($info);
				
				//echo $inout.'<br>';
				
			}	
			
			
			//exit;
			
			
			//INSERT the logs to dtr table
			$this->Stand_alone->get_logs();
			
			//exit;
			//EMPTY the dtr_temp
			
			// Display message
			echo '<b><font color=red>Downloading Logs Success!</font></b>';
			$this->Logs->insert_logs(
									$this->session->userdata('username'), 
									$this->session->userdata('office_id'), 
									'DOWNLOAD LOGS', 
									'Download logs from machine', 
									''
									);
		}
		else if (trim($msg) == 'Failed')
		{
			echo '<b><font color=red>Downloading Logs Failed! Please try again.</font></b>';
			
			$this->Logs->insert_logs(
									$this->session->userdata('username'), 
									$this->session->userdata('office_id'), 
									'DOWNLOAD LOGS', 
									'Download logs from machine', 
									'');
		}
	}
	
	// --------------------------------------------------------------------
	
	function deduct_undertime($month, $year)
	{
		$last_day = $this->Helps->get_last_day($month, $year);
	
		$last_day = $year.'-'.$month.'-'.$last_day;
		
		$this->Leave_card->set_enabled($last_day, 1);
		
		echo '<b>Done!</b>';
	}
	
	// --------------------------------------------------------------------
	
	function edit_place($mode = '')
	{
		
		if ($mode == 'cto_balance')
		{
			$c = new Compensatory_timeoff();
		
			$c->where('id', $this->input->post('rowid'));
			
			$c->get();
			
			if ( $this->input->post('colid') == 'days' )
			{
				$c->days = $this->input->post('new');
			}
			if ( $this->input->post('colid') == 'dates' )
			{
				$c->dates = $this->input->post('new');
			}
			
			$c->save();
			
			exit;
		}
		
		// --------------------------------------------------------------------
		
		if ($mode == 'leave_forward')
		{
			$employee_id = $this->input->post('rowid');
			
			$this->Leave_forwarded->update_forward_leave($employee_id, $this->input->post('colid'), $this->input->post('new'));
			exit;
		}
		
		// --------------------------------------------------------------------
		
		if ($mode == 'schedule')
		{
			//echo 'schedule';
			$new = $this->input->post('new');
			
			//$new_value = str_replace(':','', $this->input->post('new'));
			
			$this->Schedule_employees->update_Schedule($this->input->post('colid'), 
								   			 $new, 
								   			 $this->input->post('rowid')
								   			);		   
			exit;
		}
		
		// --------------------------------------------------------------------
		
		if ($mode == 'salary_grade')
		{			
			$id = $this->input->post('rowid');
						
			$data	= array(
					$this->input->post('colid') => $this->input->post('new') 
					);
			
			$this->Salary_grade->update_salary_grade($data, $id);
			exit;
		}
		
		// --------------------------------------------------------------------
		
		if ($mode == 'salary_grade_proposed')
		{			
			$this->load->model('salary_grade_proposed_m');
			
			$s = new Salary_grade_proposed_m();
			
			$id = $this->input->post('rowid');
						
			$data	= array(
					$this->input->post('colid') => $this->input->post('new') 
					);
			
			$s->update_salary_grade($data, $id);
			exit;
		}
		
		// --------------------------------------------------------------------
		
		if ($mode == 'encode_leave_card')
		{
			// Validation
			//$this->form_validation->set_rules('employee_id', 'Employee ID', 'required|callback_employee_id_check');
			$this->form_validation->set_rules('period', 'Period', 'required');
			
			if ($this->form_validation->run($this) == FALSE)
			{
				
			}
			
			$this->load->model('leave_card_m');
			
			$l = new Leave_card_m();
			
			$l->where('id', $this->input->post('rowid'));
			
			$l->get();
						
			$column = $this->input->post('colid');
			
			$new_value = $this->input->post('new');
			
			if ($column == 'period')
			{

			}
			
			$l->$column = $new_value;
			
			$l->save();
			
			exit;
		}
		
		// --------------------------------------------------------------------
		
		//$_POST['colid'] = 'ob_leave';
		//$_POST['new'] = '';
	
		//$colid = table field, $new = new value, $rowid = table row id
		if ($this->input->post('colid') == 'ob_leave')
		{
			
			if(trim($this->input->post('new')) == '')
			{
				$data	= array('notes' => $this->input->post('new') );
				
				// Get manual_log_id in table dtr
				$manual_log_id = $this->Dtr->get_manual_log_id($this->input->post('rowid'));
				
				// Execute the update
				$this->Manual_log->update_manual_log($data, $manual_log_id);
			}
		
			$is_ob = $this->Dtr->is_ob($this->input->post('rowid'));

			// This is for OB
			if($is_ob == TRUE)
			{
				$dtr_details = $this->Dtr->get_dtr_details($this->input->post('rowid'));
				//exit;
				$office_id = $this->Employee->get_single_field('office_id', $dtr_details['employee_id']);
				
				$is_ob_half = $this->Dtr->is_ob_half($this->input->post('rowid'));
				
				$half_day = $dtr_details['log_date'];
				
				if($is_ob_half == TRUE)
				{
					$half_day = 'Half Day';
				}
				
				$is_manual_log_exists = $this->Manual_log->is_manual_log_exists(
											$dtr_details['employee_id'], 
											1, 
											$dtr_details['log_date']
											);
											
								
				if ($is_manual_log_exists == FALSE)
				{
				
					$data = array(
							'employee_id' 			=> $dtr_details['employee_id'],
							'office_id'				=> $dtr_details['office_id'],
							'log_type' 				=> 1,
							'if_single_time' 		=> '',
							'cover_if_ob_or_leave' 	=> $dtr_details['log_date'],
							'cover_if_ob_or_leave2' => $half_day,
							'notes' 				=> $this->input->post('new')
							);
							
					$id = $this->Manual_log->insert_manual_log($data);
					
					$this->Dtr->update_dtr('manual_log_id', $id, $this->input->post('rowid'));
				}
				
				if($is_manual_log_exists != FALSE)
				{
					//fields
					$data	= array(
								'if_single_time' 			=> '', 
								'cover_if_ob_or_leave' 		=> $dtr_details['log_date'],
								'cover_if_ob_or_leave2' 	=> $half_day, 
								'notes' 					=> $this->input->post('new')
						);
					
					$this->Manual_log->update_manual_log($data, $is_manual_log_exists);
					
					$this->Dtr->update_dtr('manual_log_id', $is_manual_log_exists, $this->input->post('rowid'));
				}
				
			}
			
			// this is for leave==============================================================================
			$is_leave = $this->Dtr->is_leave($this->input->post('rowid'));
			
			if($is_leave == TRUE)
			{
				$dtr_details = $this->Dtr->get_dtr_details($this->input->post('rowid'));
				
				$office_id = $this->Employee->get_single_field('office_id', $dtr_details['employee_id']);
				
				$is_leave_half = $this->Dtr->is_leave_half($this->input->post('rowid'));
				
				$half_day = $dtr_details['log_date'];
				
				$value_day = 1;
				
				if($is_leave_half == TRUE)
				{
					$half_day = 'Half Day';
					$value_day = 0.5;
				}
				
				//Tel what kind of leave
				if($this->input->post('new') == 'vl' or $this->input->post('new') == 'SL')
				{
					$notes = 'Vacation Leave';
					$leave_type_id = 1;
				}
				if($this->input->post('new') == 'sl' or $this->input->post('new') == 'VL')
				{
					$notes = 'Sick Leave';
					$leave_type_id = 2;
				}
				if($this->input->post('new') != 'sl' or $this->input->post('new') != 'VL' or 
				   $this->input->post('new') != 'vl' or $this->input->post('new') != 'SL')
				{
					//echo 'Invalid input!!!';
				}
				
				$is_manual_log_exists = $this->Manual_log->is_manual_log_exists(
										$dtr_details['employee_id'], 
										2, 
										$dtr_details['log_date']
										);
				
				if ($is_manual_log_exists == FALSE)
				{
				
					$data = array(
							'employee_id' 				=> $dtr_details['employee_id'],
							'office_id'					=> $office_id,
							'log_type' 					=> 2,
							'if_single_time' 			=> '',
							'cover_if_ob_or_leave' 		=> $dtr_details['log_date'],
							'cover_if_ob_or_leave2' 	=> $half_day,
							'notes' => $notes
							);
					$id = $this->Manual_log->insert_manual_log($data);
					
					$manual_log_id = $id;
					
					$this->Dtr->update_dtr('manual_log_id', $id, $this->input->post('rowid'));
					$this->Dtr->update_dtr('leave_type_id', $leave_type_id, $this->input->post('rowid'));
				}
				if($is_manual_log_exists != FALSE)
				{
					$data	= array(
						'if_single_time' 		=> '', 
						'cover_if_ob_or_leave' 	=> $dtr_details['log_date'],
						'cover_if_ob_or_leave2' => $half_day,
						'notes' 				=> $notes
						);
					
					$this->Manual_log->update_manual_log($data, $is_manual_log_exists);
					
					$this->Dtr->update_dtr('manual_log_id', $is_manual_log_exists, $this->input->post('rowid'));
					$this->Dtr->update_dtr('leave_type_id', $leave_type_id, $this->input->post('rowid'));
					
					$manual_log_id = $is_manual_log_exists;
				}
				
			}
			
		}
		else // Use for editing attendance ===============================================
		{
			$new = $this->input->post('new');
			
			$new_value = str_replace(':','', $this->input->post('new'));
			
			if ($new_value == 'OB' or $new_value == 'ob')
			{
				$new = 'Official Business';
			}
			if ($new_value == 'Leave' or $new_value == 'leave' or $new_value == 'l')
			{
				$new = 'Leave';
			}
			
			// Check if employee PM IN is 12:00
			$dtr_details = $this->Dtr->get_dtr_details($this->input->post('rowid'));
			$se = $this->Schedule_employees->get_schedule( $dtr_details['employee_id'] );
			
			if ( !empty($se) )
			{
				if ( $se['pm_in'] == '12:00' )
				{
					$this->Dtr->is_pm_in12 = TRUE;
				}
			}
			
			
			
			$this->Dtr->update_dtr($this->input->post('colid'), 
								   $new, 
								   $this->input->post('rowid')
								   );
								   
			
			
			
								   
								   
			//to do(if value is official business
			//check if there is manual log
			//if there is none then create entry in manual logs
		}
		
		
		$dtr_details = $this->Dtr->get_dtr_details($this->input->post('rowid'));
		
		
		// Lets add the original logs
		$old 		= $this->input->post('old');
		$dtr_id 	= $this->input->post('rowid');
		$column  	= $this->input->post('colid');
		
		$dtr = new Dtr_m();
		$dtr->get_by_id($this->input->post('rowid'));
		
		
		$orig_dtr = $dtr_details['orig_dtr'];
		
		$orig_dtr = json_decode($orig_dtr);
						
		$c = $this->input->post('colid');
		
		if ($this->input->post('old') == '')
		{
			$old = 'No Log';
		}
		
		// Check if exist first//
		// We need to update only if the orig log is not exists.
		if ( ! isset($orig_dtr->$c))
		{
			$orig_dtr->$c = $old;
		}
		if ($orig_dtr->$c == NULL )
		{
			$orig_dtr->$c = $old;
		}
		
		$orig_dtr = json_encode($orig_dtr);
		
		$dtr->orig_dtr = $orig_dtr;
		$dtr->save();
		
			
			$old = $this->input->post('old');
			$new = $this->input->post('new');
			
			if ($this->input->post('old') == '')
			{
				$old = 'No Log';
			}
			if ($this->input->post('new') == '')
			{
				$new = 'No Log';
			}
			
		//use for use logs
		$this->Logs->insert_logs($this->session->userdata('username'), 
								 $this->session->userdata('office_id'), 
								 'EDIT LOGS', 
								 'Edited '.$this->input->post('colid').'('.$dtr_details['log_date'].') Change from '.
								 $old.' to '.$new, 
								 $dtr_details['employee_id']);

	}
	
	// --------------------------------------------------------------------
	
	function file_leave($employee_id = '', $multiple = '', $month = '', $year = '', 
						$leave_type_id = '', $month5 = '', $year5 = '', $multiple5 = '', 
						$special_priv_id = '', $days = '', $mone = '', $process = 0, 
						$allow_sat_sun = 0, $hospital_leave_days = '')
	{
		//echo $days;
		//echo $month.'-'.$multiple.'-'.$year.'<br>';
		//echo $month5.'-'.$multiple5.'-'.$year5.'<br>';
		
		//$date = '2012-03-01';// current date
		
		//$date = strtotime(date("Y-m-d", strtotime($date)) . " +60 days");
		
		//echo date("Y-m-d", $date);
		
		//echo date('Y-m-d', strtotime('2012-03-01'." +60 days"));
		
		//$d = mktime(0,0,0,$month= '03',$day = '01',$year = 2012);
		///$end_date = date("Y-m-d",strtotime("+60 days",$d));
		
		
		
		
		//echo $end_date.'00';
		
		//exit;
		//echo $allow_sat_sun.' allow';
		
		// If not approved_leave replace dash with underscore
		if ( $employee_id != 'approved_leave' )
		{
			$employee_id = str_replace('_','-',$employee_id);
		}
		
		// If $days not equal to zero meaning this one is
		// monetize, replace dash with underscore
		if ( $days != '0' and $days != '')
		{
			// If days is not nomeric because it has a underscore on it
			if ( ! is_numeric($days))
			{
				$days = str_replace('_','-',$days);
				
				list($monetize_vl, $monetize_sl) = explode('-', $days);
			}
		}
		
		
		// if hospital entered days equivalent
		if ( $hospital_leave_days != 'undefined')
		{
			$days = $hospital_leave_days;
		}
		
		$params = array(
						'employee_id' 		=> $employee_id,
						'multiple'			=> $multiple,
						'month'				=> $month,
						'year'				=> $year,
						'leave_type_id'		=> $leave_type_id,
						'month5'			=> $month5,
						'year5'				=> $year5,
						'multiple5'			=> $multiple5,
						'special_priv_id'	=> $special_priv_id,
						'days'				=> $days,
						'mone'				=> $mone,
						'process'			=> $process,
						'allow_sat_sun'		=> $allow_sat_sun
						);
		
		$this->load->library('leave/leave', $params);
				
		if ($this->leave->employee_id == 'approved_leave')
		{
			
			$leave_apps_id = $this->leave->multiple;
			
			$leave_apps = $this->Leave_apps->get_leave_apps_info($leave_apps_id);
			
			$params = array(
						'employee_id' 		=> $leave_apps['employee_id'],
						'multiple'			=> $leave_apps['multiple'],
						'month'				=> $leave_apps['month'],
						'year'				=> $leave_apps['year'],
						'leave_type_id'		=> $leave_apps['leave_type_id'],
						'month5'			=> $leave_apps['month5'],
						'year5'				=> $leave_apps['year5'],
						'multiple5'			=> $leave_apps['multiple5'],
						'special_priv_id'	=> $leave_apps['special_priv_id'],
						'days'				=> $leave_apps['days'],
						'mone'				=> $leave_apps['mone'],
						'allow_sat_sun'		=> $leave_apps['allow_sat_sun'],
						'process'			=> 2						
						);
			
			$process = 2;
			
			// Initilize and reset
			$this->leave->initialize($params);
			
			// Set the leave to approved
			$this->Leave_apps->set_approved($leave_apps_id);
			
		}
		
		if(!is_numeric($this->leave->employee_id))
		{
			// Check if the employee id exists
			$is_employee_id_exists = $this->Employee->is_employee_id_exists($employee_id);
			
			// if employee id does not exists
			if ( $is_employee_id_exists == FALSE)
			{
				// If the process is not equal to 2 
				//(if $process == 2 meaning approved) exit the script
				if ( $process != 2)
				{
					echo $this->view_name($this->leave->employee_id);
					exit;
				}
			}
			
			
		}
		
		$this->leave->multiple  = str_replace ("_", ",", $this->leave->multiple);
		
		$this->leave->multiple  = str_replace (" ", "",  $this->leave->multiple);
		
		
		$dates = explode(",", $this->leave->multiple);
	
		$name = $this->Employee->get_employee_info($this->leave->employee_id);
		//echo $this->leave->leave_type_id;
		if ($process != 2)
		{
			// Output name if exists
			$this->leave->is_employee($name);
			
			//echo $this->leave->leave_type_id.'hehe';
			
		}
		
		$invalid = '';
		
		$this->leave->dates = $dates;
		
		$this->leave->process_dates();
		//echo $this->leave->count_leave.'-'.$this->leave->mone.'-';
		$this->leave->dates = array_unique($this->leave->date_process);
		
		$office_id = $this->Employee->get_single_field('office_id', $this->leave->employee_id);
		
		$notes = $this->Leave_type->get_leave_name($this->leave->leave_type_id);
		
		//echo $leave_type_id.'aaa';
		
		//
		if ($this->leave->days != '')
		{
			$this->leave->count_leave = $this->leave->days;
		}
		
		// If multiple months
		
		if ($this->leave->multiple !='' && $this->leave->multiple5 !='')
		{
			$this->leave->multiple_months();
		}
		
		if ( $this->leave->leave_type_id == 9)
		{
			$this->leave->count_leave = $this->leave->days;
		}
		
		// View only if not online apps
		if ($process != 2)
		{
			// 6.15.2011 5.33pm ===============
			if ( $this->leave->leave_type_id == 21)
			{
				$leave_type_id = $this->leave->leave_type_id;
				
				$total_leave = $this->Leave_card->get_total_leave_credits($employee_id);
				
				$this->leave->leave_type_id = $leave_type_id;
			
				$vbalance =  $total_leave['vacation'];
				$sbalance =  $total_leave['sick'];
				
				$total_leave_balance = $vbalance + $sbalance;
								
				$this->leave->count_leave = $total_leave_balance;
			}
			// ================================
			
			// If maternity leave
			if ( $this->leave->leave_type_id == 5)
			{					
				// check if auto 60 days
				$auto_sixty_days = $this->Settings->get_selected_field('auto_sixty_days'); 
				
				
				if ( $auto_sixty_days == 'yes' )
				{
					$this->leave->count_leave = 60;
				}
				
			}
			
			// If paternity leave
			if ( $this->leave->leave_type_id == 4)
			{					
				// check if auto 7 days
				$auto_seven_days = $this->Settings->get_selected_field('auto_seven_days'); 
				
				
				if ( $auto_seven_days == 'yes' )
				{
					$this->leave->count_leave = 7;
				}
				
			}
			
			// If monetization is both VL and SL
			if (isset($monetize_vl) and isset($monetize_sl))
			{
				$this->leave->count_leave = $monetize_vl + $monetize_sl;
			}
			
			echo $this->leave->count_leave.' '.$notes.'<br><br>';
			
			
		}
		
		
		// If date is sat sun or holiday
		$hidden_sat_sun = ($this->leave->count_leave == 0) ? '1' : '0';
		
		echo '<input name="sat_sun" type="hidden" id="sat_sun" value="'.$hidden_sat_sun.'" />';	
		
		// Get the max and min dates
		$this->leave->max_min_date();
		$max_date = $this->leave->max_date;
		$min_date = $this->leave->min_date;
		
		
		//var_dump($process);
		
		if ($process || $process == 2)
		{
			
			// to do:
			// check if the application exists to avoid duplicate applications
			//if ($this->session->userdata('user_type') == 5 && $mode != 'approved_leave')
			if ( $this->session->userdata('user_type') == 5)
			{	
				// Check if the application exists
				$info = array(
						'employee_id' 		=> $this->leave->employee_id,
						'office_id'			=> $office_id,
						'multiple'			=> $this->leave->multiple,
						'month'				=> $this->leave->month,
						'year'				=> $this->leave->year,
						'leave_type_id'		=> $this->leave->leave_type_id,
						'month5'			=> $this->leave->month5,
						'year5'				=> $this->leave->year5,
						'multiple5'			=> $this->leave->multiple5,
						'special_priv_id'	=> $this->leave->special_priv_id,
						'days'				=> $this->leave->count_leave,
						'mone'				=> $this->leave->mone
						);
								
				$is_leave_apps_exists = $this->Leave_apps->is_leave_apps_exists($info);
				
				if ( $is_leave_apps_exists == TRUE )
				{
					?>
					<script>
					$('#messages').hide('slow');
					$('#messages').removeClass();
					$('#messages').addClass("clean-red");
					$('#messages').html('This Leave application already exists!');
					$('#messages').slideDown('slow');
					$('#multiple').val("");
					$('#allow_sat_sun').attr("checked", false);
					</script>
					<?php
					exit;
				}
				
				$info = array(
						'employee_id' 		=> $this->leave->employee_id,
						'office_id'			=> $office_id,
						'multiple'			=> $this->leave->multiple,
						'month'				=> $this->leave->month,
						'year'				=> $this->leave->year,
						'leave_type_id'		=> $this->leave->leave_type_id,
						'month5'			=> $this->leave->month5,
						'year5'				=> $this->leave->year5,
						'multiple5'			=> $this->leave->multiple5,
						'special_priv_id'	=> $this->leave->special_priv_id,
						'days'				=> $this->leave->count_leave,
						'mone'				=> $this->leave->mone,
						'date_encode'		=> date('Y-m-d'),
						'allow_sat_sun'		=> $this->leave->allow_sat_sun,
						'username'			=> $this->session->userdata('username')
						);		
						
				$leave_apps_id = $this->Leave_apps->insert_leave_apps($info);
				
				
				?>
                <script>
               
				$('#messages').hide('slow');
				$('#messages').addClass("clean-green");
				$('#messages').html('Leave application was set for approval.<br>You may print your leave application now. ' + '<a href="#" onClick="print_preview(<?php echo intval($leave_apps_id);?>)">Print Preview</a>');
				$('#messages').slideDown('slow');
				$('#multiple').val("");
				$('#allow_sat_sun').attr("checked", false);
                </script>
               
				<?php
				exit;
			}
			
			// INSERT TO MANUAL LOG
			$info = array(
						"employee_id" 			=> $this->leave->employee_id, 
						"office_id" 			=> $office_id,
						"cover_if_ob_or_leave" 	=> $min_date,
						"cover_if_ob_or_leave2" => $max_date,
						"multiple"				=> 0,
						"log_type" 				=> 2,
						"notes" 				=> $notes
			);
					
			// Get the ID of inserted values
			$manual_log_id = $this->Manual_log->insert_manual_log($info);
			
			//==========ADD TO LEAVE CARD=======================
						
			$this->leave->action_taken = $this->Helps->get_month_name($this->leave->month).' '.
																	  $this->leave->multiple.', '.
																	  $this->leave->year;
			
			// If settings is not chrnological order in leave
			$leave_order_chrono = $this->Settings->get_selected_field('leave_order_chrono');
			
			if ($leave_order_chrono == 0)
			{
				$max_date = date('Y-m-d');
			}
			
			// If multiple months===================
			if ($this->leave->multiple !='' && $this->leave->multiple5 !='')
			{
				$month_name1 = $this->Helps->get_month_name($this->leave->month);
				$month_name2 = $this->Helps->get_month_name($this->leave->month5);
				
				$this->leave->action_taken = $month_name1.' '.$this->leave->multiple. ', '.$this->leave->year. '-'.
											 $month_name2.' '.$this->leave->multiple5.', '.$this->leave->year5;
				
				$max_date = $this->leave->year5.'-'.
							$this->leave->month5.'-'.
							$this->leave->multiple5;
							
							
			}
			
			
			
			// If monetization
			if ($this->leave->leave_type_id == 9)
			{
				$lgu_code = $this->Settings->get_selected_field( 'lgu_code' );
				
				if ($lgu_code == 'laguna_province')
				{
					$this->leave->action_taken = $this->leave->action_taken;
					
					$max_date = $this->leave->year.'-'.$this->leave->month.'-'.$this->leave->multiple;
				}
				else
				{
					$this->leave->action_taken = date('F d, Y');
					
				}
				
			}
			
			// If auto 60 days for maternity leave
			if (isset($auto_sixty_days) and $auto_sixty_days == 'yes')
			{				
				$maternity_start = $year.'-'.$month.'-'.$multiple;
				
				$maternity_end = strtotime ( '+59 day' , strtotime ( $maternity_start ) ) ;
				$maternity_end = date ( 'F d, Y' , $maternity_end );
				
				$month_name1 = $this->Helps->get_month_name($this->leave->month);
				
				$this->leave->action_taken = $month_name1.' '.$this->leave->multiple. ', '.$this->leave->year. '-'.
											 $maternity_end;
				 
			}
			
			// If auto 7 days for paternity leave
			if (isset($auto_seven_days) and $auto_seven_days == 'yes')
			{				
				$paternity_start = $year.'-'.$month.'-'.$multiple;
				
				$paternity_days = 0;
				
				
				while ( $paternity_days != 7)
				{
					
					
					list($log_year, $log_month, $log_day) = explode('-', $paternity_start);
					
					
					// Check if the day is Sat or Sun
					$sat_or_sun = $this->Helps->is_sat_sun($log_month, $log_day, $log_year);
					
					// Check if the day is holiday
					$is_holiday = $this->Holiday->is_holiday($paternity_start);
					
					//var_dump($is_holiday);
					
					if ( $sat_or_sun != 'Saturday' and $sat_or_sun != 'Sunday' and $is_holiday == FALSE)
					{
						$paternity_days ++;
						
					}
					
					$paternity_end = strtotime ( '+1 day' , strtotime ( $paternity_start ) ) ;
					
					$paternity_start = strtotime ( '+1 day' , strtotime ( $paternity_start ) ) ;
					$paternity_start = date ( 'Y-m-d' , $paternity_start );
					
					
					$paternity_end = date ( 'F d, Y' , $paternity_end );
					
					
				}
								
				// We remove 1 day since after ending the while loop
				// it still add another day
				$paternity_end = strtotime ( '-1 day' , strtotime ( $paternity_end ) ) ;
				$paternity_end = date ( 'F d, Y' , $paternity_end );
				
				
				$month_name1 = $this->Helps->get_month_name($this->leave->month);
				
				$this->leave->action_taken = $month_name1.' '.$this->leave->multiple. ', '.$this->leave->year. '-'.
											 $paternity_end;
				 
			}
			
			// Check if the entry exists before saving the leave
			$is_entry_exists = $this->Leave_card->is_entry_exists(
									$this->leave->employee_id, 
									$this->leave->action_taken);			
									
			if ( $is_entry_exists == TRUE )
			{
				?>
				<script>
				$('.clean-green').hide('slow');
				$('#messages').hide('slow');
				$('#messages').removeClass();
				$('#messages').addClass("clean-red");
				$('#messages').html('This Leave application already exists!');
				$('#messages').slideDown('slow');
				$('#multiple').val("");
				$('#allow_sat_sun').attr("checked", false);
				</script>
				<?php
				exit;
			}
			
			//echo $this->leave->leave_type_id.'hehe';
			//exit;
			
			// VL
			if ($this->leave->leave_type_id == 1)
			{
				$info = array(
							"employee_id"		=> $this->leave->employee_id,
							"particulars"		=> $this->leave->count_leave.' VL',
							'v_abs' 			=> $this->leave->count_leave, 
							"action_take" 		=> $this->leave->action_taken,
							"date"				=> $max_date,
							"leave_type_id" 	=> $this->leave->leave_type_id,
							"manual_log_id"		=> $manual_log_id	
							);
				$this->Leave_card->add_leave_card($info);
					
			}
			// Sick leave
			if ($this->leave->leave_type_id == 2)
			{
				$info = array(
							"employee_id"		=> $this->leave->employee_id,
							"particulars"		=> $this->leave->count_leave.' SL',
							's_abs' 			=> $this->leave->count_leave, 
							"action_take" 		=> $this->leave->action_taken,
							"date"				=> $max_date,
							"leave_type_id" 	=> $this->leave->leave_type_id,
							"manual_log_id"		=> $manual_log_id	
							);
				$this->Leave_card->add_leave_card($info);
				
			}
			
			// Special Privilege Leave(MC#6)
			if ($this->leave->leave_type_id == 3)
			{
				$this->leave->special_priv_id = $special_priv_id;
				
				
				$special_priv = $this->leave->special_priv();
				
				$info = array(
							"employee_id"		=> $this->leave->employee_id,
							"particulars"		=> $this->leave->count_leave.' '.$special_priv,
							'v_abs' 			=> $this->leave->count_leave, 
							"action_take" 		=> $this->leave->action_taken,
							"date"				=> $max_date,
							"leave_type_id" 	=> $this->leave->leave_type_id,
							"special_priv_id"	=> $this->leave->special_priv_id,
							"manual_log_id"		=> $manual_log_id	
							);
				
				$auto_deduct_mc_vl = $this->Settings->get_selected_field( 'auto_deduct_mc_vl' );
				
				if ($auto_deduct_mc_vl == 'yes')
				{
					// Lets check if the MC spent is 3 days or more
					$mc_balance = $this->Leave_card->get_mc_balance($this->leave->employee_id, $this->leave->year);
					
					// Lets deduct the leave to VL
					// if there is no enough MC credits
					if ($mc_balance <= 0)
					{
						$info['v_abs'] 			= $this->leave->count_leave;
						$info['leave_type_id'] 	= 1; // Vacation Leave
					}
				}
						
				$this->Leave_card->add_leave_card($info);
				
			}
			
			// Paternity leave
			if ($this->leave->leave_type_id == 4)
			{
				$info = array(
							"employee_id"		=> $this->leave->employee_id,
							"particulars"		=> $this->leave->count_leave.' Paternity Leave',
							's_abs' 			=> $this->leave->count_leave, 
							"action_take" 		=> $this->leave->action_taken,
							"date"				=> $max_date,
							"leave_type_id" 	=> $this->leave->leave_type_id,
							"manual_log_id"		=> $manual_log_id	
							);
				$this->Leave_card->add_leave_card($info);
							
			}
			
			// Maternity leave
			if ($this->leave->leave_type_id == 5)
			{
				$info = array(
							"employee_id"		=> $this->leave->employee_id,
							"particulars"		=> $this->leave->count_leave.' Maternity Leave',
							's_abs' 			=> $this->leave->count_leave, 
							"action_take" 		=> $this->leave->action_taken,
							"date"				=> $max_date,
							"leave_type_id" 	=> $this->leave->leave_type_id,
							"manual_log_id"		=> $manual_log_id	
							);
							
				$this->Leave_card->add_leave_card($info);
			}
			
			// Solo parent leave
			if ($this->leave->leave_type_id == 6)
			{
				$info = array(
							"employee_id"		=> $this->leave->employee_id,
							"particulars"		=> $this->leave->count_leave.' Solo Parent',
							's_abs' 			=> $this->leave->count_leave, 
							"action_take" 		=> $this->leave->action_taken,
							"date"				=> $max_date,
							"leave_type_id" 	=> $this->leave->leave_type_id,
							"manual_log_id"		=> $manual_log_id	
							);
				$this->Leave_card->add_leave_card($info);
			}
			
			// Forced leave
			if ($this->leave->leave_type_id == 7)
			{
				$info = array(
							"employee_id"		=> $this->leave->employee_id,
							"particulars"		=> $this->leave->count_leave.' Forced Leave',
							'v_abs' 			=> $this->leave->count_leave, 
							"action_take" 		=> $this->leave->action_taken,
							"date"				=> $max_date,
							"leave_type_id" 	=> $this->leave->leave_type_id,
							"manual_log_id"		=> $manual_log_id	
							);
				$this->Leave_card->add_leave_card($info);
				
			}
			
			// Monetization leave
			if ($this->leave->leave_type_id == 9)
			{
				
				//monetary VL
				if ($this->leave->mone == 1)
				{
					$info = array(
							"employee_id"		=> $this->leave->employee_id,
							"particulars"		=> $this->leave->count_leave.' days Monet.',
							'v_abs' 			=> $this->leave->count_leave, 
							"action_take" 		=> $this->leave->action_taken,
							"date"				=> $max_date,
							"leave_type_id" 	=> $this->leave->leave_type_id,
							"manual_log_id"		=> $manual_log_id	
							);
						
				}
				// Monetary SL
				if ($this->leave->mone == 2)
				{
					$info = array(
							"employee_id"		=> $this->leave->employee_id,
							"particulars"		=> $this->leave->count_leave.' days Monet.',
							's_abs' 			=> $this->leave->count_leave, 
							"action_take" 		=> $this->leave->action_taken,
							"date"				=> $max_date,
							"leave_type_id" 	=> $this->leave->leave_type_id,
							"manual_log_id"		=> $manual_log_id	
							);
				}
				
				// If monetization is both VL and SL
				if (isset($monetize_vl) and isset($monetize_sl))
				{
					$info['particulars'] = $monetize_vl + $monetize_sl.' days Monet.';
					$info['v_abs'] = $monetize_vl;
					$info['s_abs'] = $monetize_sl;
				}
				
				$this->Leave_card->add_leave_card($info);
				
				// Exit the script
				?><script>
				//show_leave_card($('#employee_id').val())
				$('#multiple').val("");
				$('#days').val("");
				$('#hospital_leave_days').val("");
				$('#leave_card').load("<?php echo base_url().('ajax/show_leave_card/'); ?>" + $('#employee_id').val());
                </script>
				<?php
				exit;
			}
			
			// Sick leave w/out pay // 12282011 2.44pm
			if ($this->leave->leave_type_id == 16)
			{
				$info = array(
							"employee_id"		=> $this->leave->employee_id,
							"particulars"		=> $this->leave->count_leave.' Sick Leave w/o Pay',
							"action_take" 		=> $this->leave->action_taken,
							's_abs_wop' 		=> $this->leave->count_leave,
							"date"				=> $max_date,
							"leave_type_id" 	=> $this->leave->leave_type_id,
							"manual_log_id"		=> $manual_log_id,
							);
				$this->Leave_card->add_leave_card($info);
			}
			
			// Compensatory
			if ($this->leave->leave_type_id == 18)
			{
				$info = array(
							"employee_id"		=> $this->leave->employee_id,
							"particulars"		=> $this->leave->count_leave.' Compensatory Leave',
							"action_take" 		=> $this->leave->action_taken,
							"date"				=> $max_date,
							"leave_type_id" 	=> $this->leave->leave_type_id,
							"manual_log_id"		=> $manual_log_id,
							"enabled"			=> 0
							);
				$this->Leave_card->add_leave_card($info);
			}
			
			// Special leave for Women
			if ($this->leave->leave_type_id == 20)
			{
				$info = array(
							"employee_id"		=> $this->leave->employee_id,
							"particulars"		=> $this->leave->count_leave.' Special Leave for Women',
							"action_take" 		=> $this->leave->action_taken,
							"date"				=> $max_date,
							"leave_type_id" 	=> $this->leave->leave_type_id,
							"manual_log_id"		=> $manual_log_id	
							);
				$this->Leave_card->add_leave_card($info);
							
			}
			
			// Terminal Leave 6.15.2011 5:25pm
			if ($this->leave->leave_type_id == 21)
			{
				$info = array(
							"employee_id"		=> $this->leave->employee_id,
							"particulars"		=> $this->leave->count_leave.' Terminal Leave',
							"action_take" 		=> $this->leave->action_taken,
							"date"				=> $max_date,
							"leave_type_id" 	=> $this->leave->leave_type_id,
							"manual_log_id"		=> $manual_log_id	
							);
				$this->Leave_card->add_leave_card($info);
							
			}
			
			// Centennial Leave 3.7.2012 1.42pm
			if ($this->leave->leave_type_id == 22)
			{
				$info = array(
							"employee_id"		=> $this->leave->employee_id,
							"particulars"		=> $this->leave->count_leave.' Centennial Leave',
							"action_take" 		=> $this->leave->action_taken,
							"date"				=> $max_date,
							"leave_type_id" 	=> $this->leave->leave_type_id,
							"manual_log_id"		=> $manual_log_id	
							);
				$this->Leave_card->add_leave_card($info);
							
			}
			
			// Rural Service Leave 3.27.2012 1:38pm
			if ($this->leave->leave_type_id == 23)
			{
				
				
				$info = array(
							"employee_id"		=> $this->leave->employee_id,
							"particulars"		=> $this->leave->count_leave.' Rural Service Leave',
							'v_abs' 			=> $this->leave->count_leave, 
							"action_take" 		=> $this->leave->action_taken,
							"date"				=> $max_date,
							"leave_type_id" 	=> $this->leave->leave_type_id,
							"manual_log_id"		=> $manual_log_id	
							);
							
				$lgu_code = $this->Settings->get_selected_field('lgu_code');
				
				// We will not deduct rural service for tita henie
				if ($lgu_code == 'laguna_province')
				{
					// If tita henie
					if ($this->leave->employee_id == '067024')
					{
						$info['particulars'] 	= $this->leave->count_leave.' Rural Service Leave';
						$info['v_abs'] 			= 0;
					}	
				}				
							
						
							
				$this->Leave_card->add_leave_card($info);
							
			}
			
			foreach ($this->leave->dates as $date)
			{
				// If half day
				if (strlen($date) > 10)
				{	
					//get am or pm
					$am_pm =  strtolower(substr($date, -2));
					
					$day = explode(" ", $date);
					
					$day = $day[0];
					
					
					if($am_pm == 'am')
					{
						$field = 'am_login';
						$field2 = 'am_logout';
					}
					
					if($am_pm=='pm')
					{
						$field = 'pm_login';
						$field2 = 'pm_logout';
					}
					
					
					//Select if log_date exist in dtr
					$is_log_date_exists = $this->Dtr->is_log_date_exists($this->leave->employee_id, $day);
						
					
					//update
					if( $is_log_date_exists == TRUE)
					{
						$info = array(
									$field 			=> 'Leave',
									$field2 		=> 'Leave',
									'leave_type_id' => $this->leave->leave_type_id,
									'leave_half_day'=> 1,
									'manual_log_id' => $manual_log_id
									);
						
						
						$this->Dtr->edit_dtr($info, $this->leave->employee_id, $day);
					}
					
					
					else //insert
					{
						$info = array(
								$field 			=> 'Leave', 
								$field2 		=> 'Leave',
								"log_date" 		=> $day,
								"employee_id" 	=> $this->leave->employee_id,
								"office_id" 	=> $office_id,
								'leave_type_id' => $this->leave->leave_type_id,
								'leave_half_day'=> 1,
								'manual_log_id' => $manual_log_id
								);
								
								
				
						$this->Dtr->insert_dtr($info);
						
						//use for use logs
						$this->Logs->insert_logs(
												$this->session->userdata('username'), 
												$this->session->userdata('office_id'), 
												'LEAVE EVENT', 
												'', 
												$this->leave->employee_id
												);
					}
						
				}
				
				else //whole day
				{
					//Select if log_date exist in dtr
					$is_log_date_exists = $this->Dtr->is_log_date_exists($this->leave->employee_id, $date);
					//delete the data if the date and employee id exists
					if($is_log_date_exists == TRUE)
					{
						
						//delete the data
						$this->Dtr->delete_dtr($this->leave->employee_id, $date);
						
						// insert the data to dtr if the type of leave is not
						// commutation or monetization
						if( $this->leave->leave_type_id < 9  ||  
							$this->leave->leave_type_id == 11 ||  
							$this->leave->leave_type_id == 16 ||  
							$this->leave->leave_type_id == 18 ||  
							$this->leave->leave_type_id == 19 ||
							$this->leave->leave_type_id == 20)
						{
							$info = array(
									"employee_id" 	=> $this->leave->employee_id, 
									"log_date" 		=> $date,
									"manual_log_id" => $manual_log_id,
									"am_login" 		=> 'Leave',
									"am_logout" 	=> 'Leave',
									"pm_login" 		=> 'Leave',
									"pm_logout" 	=> 'Leave',
									"office_id" 	=> $office_id,
									'leave_type_id' => $this->leave->leave_type_id
									);
							
							$this->Dtr->insert_dtr($info);
						}
						
					}
					
					
					// If no result found
					if($is_log_date_exists == FALSE)
					{
						//i will decide what data will be pass to dtr table. Is it OB or leave or the time itself
						//insert the data to dtr if the type of leave is not
						//commutation or monetization
						if( $this->leave->leave_type_id < 9 ||  
							$this->leave->leave_type_id == 11 ||  
							$this->leave->leave_type_id == 16 || 
							$this->leave->leave_type_id == 18 ||  
							$this->leave->leave_type_id == 19 ||
							$this->leave->leave_type_id == 20)
						{
							
							$info = array(
									"employee_id" 	=> $this->leave->employee_id, 
									"log_date" 		=> $date,
									"manual_log_id" => $manual_log_id,
									"am_login" 		=> 'Leave',
									"am_logout" 	=> 'Leave',
									"pm_login" 		=> 'Leave',
									"pm_logout" 	=> 'Leave',
									"office_id" 	=> $office_id,
									'leave_type_id' => $this->leave->leave_type_id
									);
							
							$this->Dtr->insert_dtr($info);
							
						}
		
					}
					
				}
			}
			
			if ($process == 2)
			{
				echo '<b>Leave has been approved!</b>';
			}
			
			$lgu_code = $this->Settings->get_selected_field( 'lgu_code' );
		
			?>
			<script>
			$('#multiple').val("");
			$('#hospital_leave_days').val("");
			$('#leave_card').load("<?php echo base_url().('ajax/show_leave_card/'); ?>" + $('#employee_id').val());
			$('.clean-green').show();
			<?php if ($lgu_code == 'laguna_province'):?>
				$('#month4_extra').focus();
			<?php endif;?>
			$('#allow_sat_sun').attr("checked", false);
			//$('#messages').hide();
			</script>
			<?php
		}
	}
	
	// --------------------------------------------------------------------
	
	function disapproved_leave( $leave_apps_id = '' )
	{
		
		
		$leave_apps = $this->Leave_apps->get_leave_apps_info($leave_apps_id);
		
		$params = array(
					'employee_id' 		=> $leave_apps['employee_id'],
					'multiple'			=> $leave_apps['multiple'],
					'month'				=> $leave_apps['month'],
					'year'				=> $leave_apps['year'],
					'leave_type_id'		=> $leave_apps['leave_type_id'],
					'month5'			=> $leave_apps['month5'],
					'year5'				=> $leave_apps['year5'],
					'multiple5'			=> $leave_apps['multiple5'],
					'special_priv_id'	=> $leave_apps['special_priv_id'],
					'days'				=> $leave_apps['days'],
					'mone'				=> $leave_apps['mone'],
					'allow_sat_sun'		=> $leave_apps['allow_sat_sun'],
					'process'			=> 2						
					);
		
		$process = 2;
		
		$this->load->library('leave', $params);
		
		// Initilize and reset
		$this->leave->initialize($params);
		
		$this->leave->multiple  = str_replace ("_", ",", $this->leave->multiple);
		
		$this->leave->multiple  = str_replace (" ", "",  $this->leave->multiple);
		
		
		$dates = explode(",", $this->leave->multiple);
	
		$name = $this->Employee->get_employee_info($this->leave->employee_id);
		
		$invalid = '';
		
		$this->leave->dates = $dates;
		
		$this->leave->process_dates();

		$this->leave->dates = array_unique($this->leave->date_process);
		
		$office_id = $this->Employee->get_single_field('office_id', $this->leave->employee_id);
		
		$notes = $this->Leave_type->get_leave_name($this->leave->leave_type_id);
		
		
		if ($this->leave->days != '')
		{
			$this->leave->count_leave = $this->leave->days;
		}
		
		// If multiple months
		
		if ($this->leave->multiple !='' && $this->leave->multiple5 !='')
		{
			$this->leave->multiple_months();
		}
		
		if ( $this->leave->leave_type_id == 9)
		{
			$this->leave->count_leave = $this->leave->days;
		}
		
		if ( count($this->leave->dates) > 0)
		{
			$max_date = max($this->leave->dates);
			$max_date = explode(" ", $max_date);
			$max_date = $max_date[0];
			
			$min_date = min($this->leave->dates);
			$min_date = explode(" ", $min_date);
			$min_date = $min_date[0];
		}
		
		
		if ($this->leave->leave_type_id == 9)
		{
			$max_date 	= date('Y-m-d');
			$min_date 	= date('Y-m-d');
		}
		
		// INSERT TO MANUAL LOG
		$info = array(
					"employee_id" 			=> $this->leave->employee_id, 
					"office_id" 			=> 0,
					"cover_if_ob_or_leave" 	=> $min_date,
					"cover_if_ob_or_leave2" => $max_date,
					"multiple"				=> 0,
					"log_type" 				=> 2,
					"notes" 				=> ''
		);
				
		// Get the ID of inserted values
		$manual_log_id = $this->Manual_log->insert_manual_log($info);
		
		$this->leave->action_taken = $this->Helps->get_month_name($this->leave->month).' '.
																  $this->leave->multiple.', '.
																  $this->leave->year;
																  
		$this->leave->action_taken = '<b>Disapproved due to exigency of the service</b>';														  
		
		// If settings is not chrnological order in leave
		$leave_order_chrono = $this->Settings->get_selected_field('leave_order_chrono');
		
		if ($leave_order_chrono == 0)
		{
			$max_date = date('Y-m-d');
		}
		
		// If multiple months===================
		if ($this->leave->multiple !='' && $this->leave->multiple5 !='')
		{
			$month_name1 = $this->Helps->get_month_name($this->leave->month);
			$month_name2 = $this->Helps->get_month_name($this->leave->month5);
			
			$this->leave->action_taken = $month_name1.' '.$this->leave->multiple. ', '.$this->leave->year. '-'.
										 $month_name2.' '.$this->leave->multiple5.', '.$this->leave->year5;
			
			$max_date = $this->leave->year5.'-'.
						$this->leave->month5.'-'.
						$this->leave->multiple5;
		}
		
		//echo $max_date;
		
		//echo $this->leave->leave_type_id;
		
		//echo $leave_apps_id;
		//exit;
		
		$count_leave = '';
		
		// VL
		if ($this->leave->leave_type_id == 1)
		{
			
			
			$info = array(
						"employee_id"		=> $this->leave->employee_id,
						"particulars"		=> $this->leave->count_leave.' VL',
						'v_abs' 			=> $count_leave, 
						"action_take" 		=> $this->leave->action_taken,
						"date"				=> $max_date,
						"leave_type_id" 	=> $this->leave->leave_type_id,
						"manual_log_id"		=> $manual_log_id	
						);
			$this->Leave_card->add_leave_card($info);
			
		}
		// Sick leave
		if ($this->leave->leave_type_id == 2)
		{
			$info = array(
						"employee_id"		=> $this->leave->employee_id,
						"particulars"		=> $this->leave->count_leave.' SL',
						's_abs' 			=> $count_leave, 
						"action_take" 		=> $this->leave->action_taken,
						"date"				=> $max_date,
						"leave_type_id" 	=> $this->leave->leave_type_id,
						"manual_log_id"		=> $manual_log_id	
						);
			$this->Leave_card->add_leave_card($info);
			
		}
		
		// Special Privilege Leave(MC#6)
		if ($this->leave->leave_type_id == 3)
		{
			if($this->leave->special_priv_id == 1)
			{
				$special_priv = 'Personal Milestone';
			}
			if($this->leave->special_priv_id == 2)
			{
				$special_priv = 'Parental Obligation';
			}
			if($this->leave->special_priv_id == 3)
			{
				$special_priv = 'Filial Obligation';
			}
			if($this->leave->special_priv_id == 4)
			{
				$special_priv = 'Domestic Emergency';
			}
			if($this->leave->special_priv_id == 5)
			{
				$special_priv = 'Personal Transaction';
			}
			
			$info = array(
						"employee_id"		=> $this->leave->employee_id,
						"particulars"		=> $this->leave->count_leave.' '.$special_priv,
						'v_abs' 			=> $count_leave, 
						"action_take" 		=> $this->leave->action_taken,
						"date"				=> $max_date,
						"leave_type_id" 	=> $this->leave->leave_type_id,
						"special_priv_id"	=> $this->leave->special_priv_id,
						"manual_log_id"		=> $manual_log_id	
						);
			$this->Leave_card->add_leave_card($info);
			
		}
		
		// Paternity leave
		if ($this->leave->leave_type_id == 4)
		{
			$info = array(
						"employee_id"		=> $this->leave->employee_id,
						"particulars"		=> $this->leave->count_leave.' Paternity Leave',
						's_abs' 			=> $count_leave, 
						"action_take" 		=> $this->leave->action_taken,
						"date"				=> $max_date,
						"leave_type_id" 	=> $this->leave->leave_type_id,
						"manual_log_id"		=> $manual_log_id	
						);
			$this->Leave_card->add_leave_card($info);
						
		}
		
		// Maternity leave
		if ($this->leave->leave_type_id == 5)
		{
			$info = array(
						"employee_id"		=> $this->leave->employee_id,
						"particulars"		=> $this->leave->count_leave.' Maternity Leave',
						's_abs' 			=> $count_leave, 
						"action_take" 		=> $this->leave->action_taken,
						"date"				=> $max_date,
						"leave_type_id" 	=> $this->leave->leave_type_id,
						"manual_log_id"		=> $manual_log_id	
						);
			$this->Leave_card->add_leave_card($info);
		}
		
		// Solo parent leave
		if ($this->leave->leave_type_id == 6)
		{
			$info = array(
						"employee_id"		=> $this->leave->employee_id,
						"particulars"		=> $this->leave->count_leave.' Solo Parent',
						's_abs' 			=> $count_leave, 
						"action_take" 		=> $this->leave->action_taken,
						"date"				=> $max_date,
						"leave_type_id" 	=> $this->leave->leave_type_id,
						"manual_log_id"		=> $manual_log_id	
						);
			$this->Leave_card->add_leave_card($info);
		}
		
		// Forced leave
		if ($this->leave->leave_type_id == 7)
		{
			$info = array(
						"employee_id"		=> $this->leave->employee_id,
						"particulars"		=> $this->leave->count_leave.' Forced Leave',
						'v_abs' 			=> $count_leave, 
						"action_take" 		=> $this->leave->action_taken,
						"date"				=> $max_date,
						"leave_type_id" 	=> $this->leave->leave_type_id,
						"manual_log_id"		=> $manual_log_id	
						);
			$this->Leave_card->add_leave_card($info);
			
		}
		
		// Monetization leave
		if ($this->leave->leave_type_id == 9)
		{
			//monetary VL
			if ($this->leave->mone == 1)
			{
				$info = array(
						"employee_id"		=> $this->leave->employee_id,
						"particulars"		=> $this->leave->count_leave.' days Monet.',
						'v_abs' 			=> $count_leave, 
						"action_take" 		=> $this->leave->action_taken,
						"date"				=> date('Y-m-d'),
						"leave_type_id" 	=> $this->leave->leave_type_id,
						"manual_log_id"		=> $manual_log_id	
						);
				$this->Leave_card->add_leave_card($info);
	
			}
			// Monetary SL
			if ($this->leave->mone == 2)
			{
				$info = array(
						"employee_id"		=> $this->leave->employee_id,
						"particulars"		=> $this->leave->count_leave.' days Monet.',
						's_abs' 			=> $count_leave, 
						"action_take" 		=> $this->leave->action_taken,
						"date"				=> date('Y-m-d'),
						"leave_type_id" 	=> $this->leave->leave_type_id,
						"manual_log_id"		=> $manual_log_id	
						);
				$this->Leave_card->add_leave_card($info);
			
			}
			// Exit the script
			?><script>show_leave_card($('#employee_id').val())</script><?php
			exit;
		}
		
		// Sick leave w/out pay // 12282011 2.44pm
		if ($this->leave->leave_type_id == 16)
		{
			$info = array(
						"employee_id"		=> $this->leave->employee_id,
						"particulars"		=> $this->leave->count_leave.' Sick Leave w/o Pay',
						"action_take" 		=> $this->leave->action_taken,
						's_abs_wop' 		=> $count_leave,
						"date"				=> $max_date,
						"leave_type_id" 	=> $this->leave->leave_type_id,
						"manual_log_id"		=> $manual_log_id	
						);
			$this->Leave_card->add_leave_card($info);
		}
		
		// Compensatory
		if ($this->leave->leave_type_id == 18)
		{
			$info = array(
						"employee_id"		=> $this->leave->employee_id,
						"particulars"		=> $this->leave->count_leave.' Compensatory Leave',
						"action_take" 		=> $this->leave->action_taken,
						"date"				=> $max_date,
						"leave_type_id" 	=> $this->leave->leave_type_id,
						"enabled"			=> 0,
						"manual_log_id"		=> $manual_log_id	
						);
			$this->Leave_card->add_leave_card($info);
		}
		
		// Special leave for Women
		if ($this->leave->leave_type_id == 20)
		{
			$info = array(
						"employee_id"		=> $this->leave->employee_id,
						"particulars"		=> $this->leave->count_leave.' Special Leave for Women',
						"action_take" 		=> $this->leave->action_taken,
						"date"				=> $max_date,
						"leave_type_id" 	=> $this->leave->leave_type_id,
						"manual_log_id"		=> $manual_log_id	
						);
			$this->Leave_card->add_leave_card($info);
						
		}
		
		// Terminal Leave 6.15.2011 5:25pm
		if ($this->leave->leave_type_id == 21)
		{
			$info = array(
						"employee_id"		=> $this->leave->employee_id,
						"particulars"		=> $this->leave->count_leave.' Terminal Leave',
						"action_take" 		=> $this->leave->action_taken,
						"date"				=> $max_date,
						"leave_type_id" 	=> $this->leave->leave_type_id,
						"manual_log_id"		=> $manual_log_id	
						);
			$this->Leave_card->add_leave_card($info);
						
		}
		
		
		$this->Leave_apps->set_disapproved($leave_apps_id);
		
		echo 'Leave has been disapproved!';
		
		// Set the leave to approved
		
	}
	
	// --------------------------------------------------------------------
	
	function file_cto( $process = '', $id = '' )
	{
		$employee_id 	=  $this->input->post('employee_id');
		$month 			=  $this->input->post('month');
		$year 			=  $this->input->post('year');
		$allow_sat_sun 	=  $this->input->post('allow_sat_sun');
		$process 		=  $this->input->post('process');
		$multiple  		=  $this->input->post('multiple');
		
		
		
		// If not approved_leave  replace dash with underscore
		if ( $employee_id != 'approved_leave' )
		{
			//$employee_id = str_replace('_','-',$employee_id);
		}
		
		$params = array(
						'employee_id' 		=> $employee_id,
						'multiple'			=> $multiple,
						'month'				=> $month,
						'year'				=> $year,
						'process'			=> $process,
						'allow_sat_sun'		=> $allow_sat_sun
						);
		
		$this->load->library('cto', $params);
				
		if ($this->input->post('id') != '')
		{
						
			$cto_apps = $this->Compensatory_timeoff->get_cto_apps_info($this->input->post('id'));
						
			$params = array(
						'employee_id' 		=> $cto_apps['employee_id'],
						'multiple'			=> $cto_apps['dates'],
						'month'				=> $cto_apps['month'],
						'year'				=> $cto_apps['year'],
						'process'			=> 2,
						'allow_sat_sun'		=> 1						
						);
			
			$process = 2;
			
			// Initilize and reset
			$this->cto->initialize($params);
			
			// Set the leave to approved
			$this->Compensatory_timeoff->set_approved($this->input->post('id'));
			
			
			
			//exit;
			
		}
		
		if(!is_numeric($this->cto->employee_id))
		{
			// Check if the employee id exists
			$is_employee_id_exists = $this->Employee->is_employee_id_exists($employee_id);
			
			if ( $is_employee_id_exists == FALSE)
			{
				// If the process is approved dont exit
				if ( $process == 2)
				{
					
				}
				else
				{
					//echo $this->view_name($this->cto->employee_id);
					exit;
				}
				
			}
			
			
		}
		
		$dates = explode(",", $this->cto->multiple);
		
		$name = $this->Employee->get_employee_info($this->cto->employee_id);
		
		//echo $name;
		
		if ($process != 2)
		{
			// Output name if exists
			$this->cto->is_employee($name);
			
		}
		
		$invalid = '';
		
		$this->cto->dates = $dates;
		
		$this->cto->process_dates();
		
		$this->cto->dates = array_unique($this->cto->date_process);
		
		echo $this->cto->count_leave.' day(s) Compensatory Timeoff';
		
		//print_r($this->cto->dates);
		//exit;
		
		$office_id = $this->Employee->get_single_field('office_id', $this->cto->employee_id);
				
		// View only if not online apps
		if ($process != 2)
		{
			// 6.15.2011 5.33pm ===============
			//if ( $this->cto->leave_type_id == 21)
			//{
				$total_leave = $this->Leave_card->get_total_leave_credits($employee_id);
			
				$vbalance =  $total_leave['vacation'];
				$sbalance =  $total_leave['sick'];
				
				$total_leave_balance = $vbalance + $sbalance;
								
				//$this->cto->count_leave = $total_leave_balance;
			//}
			// ================================
			
			//echo $this->cto->count_leave.'<br><br>';
			
			
		}
		
		
		// If date is sat sun or holiday
		if ($this->cto->count_leave == 0)
		{
			echo '<input name="sat_sun" type="hidden" id="sat_sun" value="1" />';	
		}
		else
		{
			echo '<input name="sat_sun" type="hidden" id="sat_sun" value="0" />';	
		}
		
		if ($process || $process == 2)
		{
							
			if ( $this->session->userdata('user_type') == 5 )
			{	
				$c = new Compensatory_timeoff();
			
				$c->employee_id = $this->cto->employee_id;
				$c->office_id 	= $office_id;
				$c->month 		= $this->cto->month;
				$c->year 		= $this->cto->year;
				$c->days 		= $this->cto->count_leave;
				$c->dates 		= $this->cto->multiple;
				$c->date_file 	= date('Y-m-d');
				$c->type 		= 'spent';
				$c->status 		= 'inactive';
				$c->save();
				
				?>
                <script>
               
				$('#messages').hide('slow');
				$('#messages').addClass("clean-green");
				$('#messages').html('CTO application was set for approval.<br>You may print your CTO application now. ' + '<a href="#" onClick="print_preview(<?php echo intval($c->id);?>)">Print Preview</a>');
				$('#messages').slideDown('slow');
				$('#multiple').val("");
				$('#allow_sat_sun').attr("checked", false);
                </script>
               
				<?php
				exit;
			}
			
			$c = new Compensatory_timeoff();
			
			$c->employee_id = $this->cto->employee_id;
			$c->office_id 	= $office_id;
			$c->month 		= $this->cto->month;
			$c->year 		= $this->cto->year;
			$c->days 		= $this->cto->count_leave;
			$c->dates 		= $this->cto->multiple;
			$c->type 		= 'spent';
			$c->status 		= 'active';
			//$c->save();
			//echo $this->input->post('id').'25333334455';
			//exit;
			
			
			
			foreach ($this->cto->dates as $date)
			{
				// If half day
				if (strlen($date) > 10)
				{	
					//get am or pm
					$am_pm =  strtolower(substr($date, -2));
					
					$day = explode(" ", $date);
					
					$day = $day[0];
					
					
					if($am_pm == 'am')
					{
						$field = 'am_login';
						$field2 = 'am_logout';
					}
					
					if($am_pm=='pm')
					{
						$field = 'pm_login';
						$field2 = 'pm_logout';
					}
					
					
					//Select if log_date exist in dtr
					$is_log_date_exists = $this->Dtr->is_log_date_exists($this->cto->employee_id, $day);
						
					
					//update
					if( $is_log_date_exists == TRUE)
					{
						$info = array(
									$field 			=> 'offset',
									$field2 		=> 'offset'
									);
						
						
						$this->Dtr->edit_dtr($info, $this->cto->employee_id, $day);
					}
					
					
					else //insert
					{
						$info = array(
								$field 						=> 'offset', 
								$field2 					=> 'offset',
								"log_date" 					=> $day,
								"employee_id" 				=> $this->cto->employee_id,
								"office_id" 				=> $cto_apps['office_id'],
								'compensatory_timeoff_id' 	=> $this->input->post('id')
								);
				
						$this->Dtr->insert_dtr($info);
						
						//use for use logs
						$this->Logs->insert_logs(
												$this->session->userdata('username'), 
												$this->session->userdata('office_id'), 
												'Compensatory Timeoff EVENT', 
												'', 
												$this->cto->employee_id
												);
					}
						
				}
				
				else //whole day
				{
					//Select if log_date exist in dtr
					$is_log_date_exists = $this->Dtr->is_log_date_exists($this->cto->employee_id, $date);
					
					//delete the data if the date and employee id exists
					if($is_log_date_exists == TRUE)
					{
						//delete the data
						$this->Dtr->delete_dtr($this->cto->employee_id, $date);
							
					}
					
					$info = array(
								"employee_id" 				=> $this->cto->employee_id, 
								"log_date" 					=> $date,
								'compensatory_timeoff_id' 	=> $this->input->post('id'),
								"am_login" 					=> 'offset',
								"am_logout" 				=> 'offset',
								"pm_login" 					=> 'offset',
								"pm_logout" 				=> 'offset',
								"office_id" 				=> $cto_apps['office_id'],
								);
						
					$this->Dtr->insert_dtr($info);
						
				}
			}
			
			if ($process == 2)
			{
				echo '<b>  has been approved!</b>';
				?>
				<script>
				//$('#messages').addClass("clean-green");
				//$('.clean-green').show();
				</script>
				<?php
			
			}
			
			?>
			<script>
			$('#multiple').val("");
			$('#leave_card').load("<?php echo base_url().('ajax/show_cto/'); ?>" + $('#employee_id').val());
			$('.clean-green').show();
			$('#allow_sat_sun').attr("checked", false);
			//$('#messages').hide();
			</script>
			<?php
		}
	}
	
	// --------------------------------------------------------------------
	
	function is_employee_id_exists($employee_id)
	{	
		$is_employee_id_exists = $this->Employee->is_employee_id_exists($employee_id);
		
		if($is_employee_id_exists == FALSE)
		{
			echo '<strong><font color=red>This ID is available.<font></strong>';
		}
		
		else
		{
			echo '<strong>'.$employee_id.'<font color=red> is taken.<font></strong>';
		}
	}
	
	// --------------------------------------------------------------------
	
	function manual_log_employees($office_id)
	{
		$data = array();
		
		$this->Employee->fields = array(
										'employee_id',
										'fname',
										'mname',
										'lname',
										'id',
										'office_id',
										'status'
										);
		$data['rows'] 	= $this->Employee->get_employee_list( $office_id );
		$total_results 	= $this->Employee->num_rows;
		
		$this->load->view('ajax/manual_log_employees', $data);
		
	}
	
	function employees_schedule($office_id)
	{
		$data = array();
		
		$this->Employee->fields = array(
										'employee_id',
										'fname',
										'mname',
										'lname',
										'id',
										'office_id',
										'status'
										);
		$data['rows'] 	= $this->Employee->get_employee_shifting( $office_id );
		$total_results 	= $this->Employee->num_rows;
		
		$this->load->view('ajax/employees_schedule', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function process_manual_log($start_ob = 0, $overwrite_logs = 0, $date1 = '', $date2 = '',
								$time1, $time2, $time3, $time4 )
	{
		
		
		$dates =  $this->Helps->get_days_in_between($date1, $date2);
		
		if($date1 == $date2)
		{
			$dates = array($date1);
		}
		
		$employees = $this->session->userdata('employees');
		
		foreach($employees as $employee_id)
		{
			$i = 0;
			
			foreach($dates as $date)
			{
				
				$office_id = $this->Employee->get_single_field('office_id', $employee_id);
				
				$shift_type = $this->Employee->get_single_field('shift_type', $employee_id);
				
				//AM LOGIN
				if ($time1 !="0:0")
				{
					
					if ($time1 == 'o:b')
					{
						$time1 = 'Official Business';
					}
					
					//Do nothing if first day manual log and start in PM
					if ($start_ob == 1 && $i == 0)
					{
					
					}
					else
					{
						
						$this->Dtr->manual_log($office_id, $employee_id, $time1, $date, 1, $shift_type, $overwrite_logs);
					}
					
				}
				
				//AM LOGOUT
				if ($time2 !="0:0")
				{
					
					if ($time2 == 'o:b')
					{
						$time2 = 'Official Business';
					}
					
					//Do nothing if first day manual log and start in PM
					if ($start_ob == 1 && $i == 0)
					{
					
					}
					else
					{
						$this->Dtr->manual_log($office_id, $employee_id, $time2, $date, 2, $shift_type, $overwrite_logs);
					}
					//echo 'ok';
				}
				
				//PM LOGIN
				if ($time3 !="0:0"){
					
					if ($time3 == 'o:b')
					{
						$time3 = 'Official Business';
					}
					else
					{
						if ($time3 < '13:00') 
						{
							$time3 = strtotime($time3.' PM');
							$time3 = date('H:i', $time3);
						}
					}
					$this->Dtr->manual_log($office_id, $employee_id, $time3, $date, 3, $shift_type, $overwrite_logs);
				}
				
				//PM LOGOUT
				if ($time4 !="0:0"){
					if ($time4 == 'o:b')
					{
						$time4 = 'Official Business';
					}
					
					else
					{
						if ($time4 < '13:00') 
						{
							$time4 = strtotime($time4.' PM');
							$time4 = date('H:i', $time4);
						}
					}
					$this->Dtr->manual_log($office_id, $employee_id, $time4, $date, 4, $shift_type, $overwrite_logs);
				}
				
				$i ++;
			}
		}
		
		//Unset the session
		$employees = array();
		$this->session->set_userdata($employees);
		
		echo 'Done!';
		
	}
	
	// --------------------------------------------------------------------
	
	function set_selected($employee_id = '', $stat = 0)
	{
		
		
		//Add
		if($stat == 1)
		{
			$employees = $this->session->userdata('employees');
			
			if ($employees == FALSE)
			{
				$employees = array();
			}
			//var_dump($employee_id);
			//Add new employees if not exists
			if ($employee_id != '')
			{
				//echo $employee_id;
				array_push($employees, $employee_id);
			}
			
			
			$employees = array_unique($employees);
			
			$this->session->set_userdata('employees', $employees);
		}
		else // Remove
		{
			
			//search empoyee id in array and delete
			$employees = $this->session->userdata('employees');
			
			$key = array_search($employee_id, $employees); 
			
			//Unset
			unset($employees[$key]);
			
			$this->session->set_userdata('employees', $employees);
		}
		
		$employees = $this->session->userdata('employees');
		
		foreach($employees as $employee_id)
		{
			if ( $employee_id != 0)
			{
				$name = $this->Employee->get_employee_info($employee_id, 'lname, fname');
				echo $name['lname'].', '.$name['fname'].'<br>';
			}
			
		}
	}
	
	// --------------------------------------------------------------------
	
	function show_employees($office_id = '', $employment = '')
	{
		$data = array();
		
		if ($office_id != '')
		{
			//If employment status not equal to all
			if ($employment != 'all')
			{
				$this->Employee->employment_type = $employment;
				
			}
			$this->Employee->fields = array(
											'employee_id',
											'id',
											'lname',
											'fname',
											'mname',
											'office_id',
											'status'
											);
			
			$data['rows'] = $this->Employee->get_employee_list($office_id);
			
			$this->load->view('ajax/show_employees', $data);
		}

	}
	
	// --------------------------------------------------------------------
	
	function show_leave_card($employee_id = '')
	{
		$data 			= array();
		
		//$data['rows'] 	= $this->Manual_log->office_manual_log($employee_id, 2, $include_hidden = 0);
		
		$encoded_leave_listing_order = $this->Settings->get_selected_field( 'encoded_leave_listing_order' );
		
		$this->Leave_card->encoded_leave_listing_order = $encoded_leave_listing_order;
		
		$this->Leave_card->fields = array(
										'employee_id', 
										'particulars', 
										'action_take', 
										'manual_log_id'
										);
		
		$data['rows']	= $this->Leave_card->get_encoded_card($employee_id);
		
		$this->load->view('ajax/show_leave_card', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function show_cto($employee_id = '')
	{
		$data 			= array();
		
		$c = new Compensatory_timeoff();
		
		$c->where('status', 'active');
		
		$data['rows']	= $c->get_by_employee_id( $employee_id );
		
		$this->Employee->fields = array('fname', 'mname', 'lname');
		
		$data['name'] = $this->Employee->get_employee_info($employee_id);
		
		$this->load->view('ajax/show_cto', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function show_undertime($employee_id = '')
	{
		$data 			= array();
				
		$this->Leave_card->fields = array(
										'id',
										'employee_id', 
										'particulars', 
										'action_take', 
										'manual_log_id'
										);
		
		$data['rows']	= $this->Leave_card->get_undertime($employee_id);
		
		
		$this->load->view('ajax/show_undertime', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function show_cto_balance($office_id = '')
	{
		$data 			= array();
		
		
		$this->Employee->fields = array(
                                'id',
                                'employee_id',
                                'office_id',
                                'lname',
                                'fname',
                                'mname'
                                );
        
		$data['rows'] = $this->Employee->get_employee_list($this->session->userdata('office_id'), '');
		
		if ($office_id != '')
		{
			$data['rows'] = $this->Employee->get_employee_list($office_id, '');
		}
		
		//
		
		
		foreach ( $data['rows'] as $row)
		{
			$c = new Compensatory_timeoff();
			
			$c->where('employee_id', $row['employee_id']);
			$c->where('type', 'balance');
			$c->get();
			
			if ( $c->exists())// Do nothing
			{
				//echo 'cool';
			}
			else// Insert blank
			{
				$c->employee_id 	= $row['employee_id'];
				$c->status 			= 'active';
				$c->type 			= 'balance';
				$c->save();
				//echo 'not cool';
			}
		}
		
		$this->load->view('ajax/show_cto_balance', $data);
	}
	
	// --------------------------------------------------------------------
	
	function show_leave_forwarded($office_id = '')
	{
		$data 			= array();
		$this->Employee->fields = array(
                                'id',
                                'employee_id',
                                'office_id',
                                'lname',
                                'fname',
                                'mname'
                                );
        
		$data['rows'] = $this->Employee->get_employee_list($this->session->userdata('office_id'), '');
		
		if ($office_id != '')
		{
			$data['rows'] = $this->Employee->get_employee_list($office_id, '');
		}
		
		$this->load->view('ajax/show_leave_forwarded', $data);
	}
	
	// --------------------------------------------------------------------
	
	function upload_data_server($date1, $date2, $download_zip = false)
	{
		//Create dtr by range of date
		$logs = $this->Dtr->get_dtr_range($date1, $date2);
		
		//Create an xml file(DTR)
		$xml_output  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
		$xml_output .= "<root>\n";
	
		foreach($logs as $log)
		{
			$xml_output .= "\t<dtr>\n";
			$xml_output .= "\t\t<employee_id>" . $log['employee_id'] . "</employee_id>\n";
			$xml_output .= "\t\t<log_date>" . $log['log_date'] . "</log_date>\n";
			$xml_output .= "\t\t<am_login>" . $log['am_login'] . "</am_login>\n";
			$xml_output .= "\t\t<am_logout>" . $log['am_logout'] . "</am_logout>\n";
			$xml_output .= "\t\t<pm_login>" . $log['pm_login'] . "</pm_login>\n";
			$xml_output .= "\t\t<pm_logout>" . $log['pm_logout'] . "</pm_logout>\n";
			$xml_output .= "\t\t<ot_login>" . $log['ot_login'] . "</ot_login>\n";
			$xml_output .= "\t\t<ot_logout>" . $log['ot_logout'] . "</ot_logout>\n";
			$xml_output .= "\t\t<leave_type_id>" . $log['leave_type_id'] . "</leave_type_id>\n";
			$xml_output .= "\t\t<leave_half_day>" . $log['leave_half_day'] . "</leave_half_day>\n";
			$xml_output .= "\t\t<office_id>" . $log['office_id'] . "</office_id>\n";
			$xml_output .= "\t\t<shift_id>" . $log['shift_id'] . "</shift_id>\n";
			$xml_output .= "\t</dtr>\n";
		}
		
		$xml_output  .=  "</root>"; 
			
		$filenamepath =   "logs/dtr.xml";
		 
		$fp = fopen($filenamepath,'w');
		
		$write = fwrite($fp,$xml_output); 
		
		
		//Employee
		$new_employees = $this->Employee->get_new_employee();
		$xml_output  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
		$xml_output .= "<root>\n";
	
		foreach($new_employees as $new_employee)
		{
			$xml_output .= "\t<employee>\n";
			$xml_output .= "\t\t<id>" . $new_employee['id'] . "</id>\n";
			$xml_output .= "\t\t<salut>" . $new_employee['salut'] . "</salut>\n";
			$xml_output .= "\t\t<fname>" . $new_employee['fname'] . "</fname>\n";
			$xml_output .= "\t\t<mname>" . $new_employee['mname'] . "</mname>\n";
			$xml_output .= "\t\t<lname>" . $new_employee['lname'] . "</lname>\n";
			$xml_output .= "\t\t<salary_grade>" . $new_employee['salary_grade'] . "</salary_grade>\n";
			$xml_output .= "\t\t<step>" . $new_employee['step'] . "</step>\n";
			//$xml_output .= "\t\t<monthly_salary>" . $new_employee['monthly_salary'] . "</monthly_salary>\n";
			$xml_output .= "\t\t<permanent>" . $new_employee['permanent'] . "</permanent>\n";
			$xml_output .= "\t\t<office_id>" . $new_employee['office_id'] . "</office_id>\n";
			$xml_output .= "\t\t<detailed_office_id>" . $new_employee['detailed_office_id'] . "</detailed_office_id>\n";
			$xml_output .= "\t\t<pics>" . $new_employee['pics'] . "</pics>\n";
			$xml_output .= "\t\t<status>" . $new_employee['status'] . "</status>\n";
			$xml_output .= "\t\t<shift_id>" . $new_employee['shift_id'] . "</shift_id>\n";
			$xml_output .= "\t\t<shift_type>" . $new_employee['shift_type'] . "</shift_type>\n";
			$xml_output .= "\t</employee>\n";
		}
		
		$xml_output  .=  "</root>"; 
			
		$filenamepath =   "logs/employee.xml";
		 
		$fp = fopen($filenamepath,'w');
		
		$write = fwrite($fp,$xml_output);
		
		// Create user logs by range of date
		$user_logs = $this->Logs->get_logs();
		
		// Create an xml file(user_logs)
		$xml_output  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
		$xml_output .= "<root>\n";
	
		foreach($user_logs as $log)
		{
			$xml_output .= "\t<logs>\n";
			$xml_output .= "\t\t<username>" . $log['username'] . "</username>\n";
			$xml_output .= "\t\t<office_id>" . $log['office_id'] . "</office_id>\n";
			$xml_output .= "\t\t<command>" . $log['command'] . "</command>\n";
			$xml_output .= "\t\t<details>" . $log['details'] . "</details>\n";
			$xml_output .= "\t\t<employee_id_affected>" . $log['employee_id_affected'] . "</employee_id_affected>\n";
			$xml_output .= "\t\t<date>" . $log['date'] . "</date>\n";
			$xml_output .= "\t</logs>\n";
		}
		
		$xml_output  .=  "</root>"; 
			
		$filenamepath =   "logs/logs.xml";
		 
		$fp = fopen($filenamepath,'w');
		
		$write = fwrite($fp,$xml_output);
		
		
		//office pass
		$passes = $this->Office_pass->get_office_pass_list($date1, $date2);
		
		//Create an xml file()
		$xml_output  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
		$xml_output .= "<root>\n";
	
		foreach($passes as $passe)
		{
			$xml_output .= "\t<office_pass>\n";
			$xml_output .= "\t\t<employee_id>" . $passe['employee_id'] . "</employee_id>\n";
			$xml_output .= "\t\t<office_id>" . $passe['office_id'] . "</office_id>\n";
			$xml_output .= "\t\t<date>" . $passe['date'] . "</date>\n";
			$xml_output .= "\t\t<time_out>" . $passe['time_out'] . "</time_out>\n";
			$xml_output .= "\t\t<time_in>" . $passe['time_in'] . "</time_in>\n";
			$xml_output .= "\t\t<seconds>" . $passe['seconds'] . "</seconds>\n";
			$xml_output .= "\t\t<date_acquired>" . $passe['date_acquired'] . "</date_acquired>\n";
			$xml_output .= "\t</office_pass>\n";
		}
		
		$xml_output  .=  "</root>"; 
			
		$filenamepath =   "logs/office_pass.xml";
		 
		$fp = fopen($filenamepath,'w');
		
		$write = fwrite($fp,$xml_output);
		
		//tardiness
		$tardiness = $this->Tardiness->get_tardiness($date1, $date2);
		
		//Create an xml file()
		$xml_output  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
		$xml_output .= "<root>\n";
	
		foreach($tardiness as $tardi)
		{
			$xml_output .= "\t<tardiness>\n";
			$xml_output .= "\t\t<employee_id>" . $tardi['employee_id'] . "</employee_id>\n";
			$xml_output .= "\t\t<office_id>" . $tardi['office_id'] . "</office_id>\n";
			$xml_output .= "\t\t<late>" . $tardi['late'] . "</late>\n";
			$xml_output .= "\t\t<undertime>" . $tardi['undertime'] . "</undertime>\n";
			$xml_output .= "\t\t<number_tardiness>" . $tardi['number_tardiness'] . "</number_tardiness>\n";
			$xml_output .= "\t\t<log_type>" . $tardi['log_type'] . "</log_type>\n";
			$xml_output .= "\t\t<date>" . $tardi['date'] . "</date>\n";
			$xml_output .= "\t\t<late_seconds>" . $tardi['late_seconds'] . "</late_seconds>\n";
			$xml_output .= "\t\t<undertime_seconds>" . $tardi['undertime_seconds'] . "</undertime_seconds>\n";
			$xml_output .= "\t\t<seconds>" . $tardi['seconds'] . "</seconds>\n";
			$xml_output .= "\t</tardiness>\n";
		}
		
		$xml_output  .=  "</root>"; 
			
		$filenamepath =   "logs/tardiness.xml";
		 
		$fp = fopen($filenamepath,'w');
		
		$write = fwrite($fp,$xml_output);
		
		$this->Zipper->addFiles(array(
			"logs/dtr.xml",
			"logs/logs.xml", 
			"logs/employee.xml",
			"logs/office_pass.xml",
			"logs/tardiness.xml"
			)
			); 
		
		$this->Zipper->output("logs/".$this->session->userdata('office_id').'-'.date('Y-m-d').".zip");
		
		
		if ($download_zip == 'true')
		{
			echo anchor(base_url().'logs/'.$this->session->userdata('office_id').'-'.date('Y-m-d').".zip", 'Download File');
			$this->Logs->insert_logs($this->session->userdata('username'), 
									 $this->session->userdata('office_id'), 
									 'DOWNLOAD ZIP FILE', 'Download zip file from computer', 
									 ''
									 );
			exit;
		}
		
	}
	
	// --------------------------------------------------------------------
	
	function view_name($employee_id, $lname = '', $fname = '')
	{
		if(!is_numeric($employee_id))
		{
			
			
			// Check if the employee id exists
			$is_employee_id_exists = $this->Employee->is_employee_id_exists($employee_id);
			
			if ( $is_employee_id_exists == TRUE)
			{
				$this->Employee->fields = array('pics', 'fname', 'mname', 'lname');
				$name = $this->Employee->get_employee_info($employee_id);
				
				if(count($name) != 0)
				{
					
					echo '<img src="'.base_url().'pics/'.$name['pics'].'" id="employee_image"/>'.
					 '<br><strong>'.$name['fname'].' '.$name['mname'].' '.$name['lname'].'</strong>';
					 
					 ?>
					<input name="valid_id" type="hidden" id="valid_id" value="1" />
					<?php
				}
				
				else
				{	
					$pics = 'not_available.jpg';
					echo '<img src="'.base_url().'pics/'.$pics.'" width="120" height="120" id="employee_image"/><br>
						 <font color="#FFFFFF">.</font>';
						 
					?>
					<input name="valid_id" type="hidden" id="valid_id" value="0" />
					<?php
				}
			}
			else
			{
				$lname = $employee_id;
				$names = $this->Employee->get_employee_list('', 
													   '', 
													   $per_page = "", 
													   $off_set = "", 
													   $lname, 
													   $fields = array());
													   
				foreach ($names as $name)
				{
					$id = $name['employee_id'];
					echo '<a href="#" onclick="change_value('."'".$id."'".')">'.$name['lname'].' '.$name['fname'].', '.$name['mname'].'</a><br>';
				}
				
				?>
				<input name="valid_id" type="hidden" id="valid_id" value="0" />
				<?php
			}
		}
		else
		{	
			$this->Employee->fields = array('pics', 'fname', 'mname', 'lname');
			$name = $this->Employee->get_employee_info($employee_id);
			
			if(count($name) != 0)
			{
				
				echo '<img src="'.base_url().'pics/'.$name['pics'].'" id="employee_image"/>'.
				 '<br><strong>'.$name['fname'].' '.$name['mname'].' '.$name['lname'].'</strong>';
				 
				 ?>
				<input name="valid_id" type="hidden" id="valid_id" value="1" />
				<?php
			}
			
			else
			{	
				$pics = 'not_available.jpg';
				echo '<img src="'.base_url().'pics/'.$pics.'" width="120" height="120" id="employee_image"/><br>
					 <font color="#FFFFFF">.</font>';
					 
				?>
				<input name="valid_id" type="hidden" id="valid_id" value="0" />
				<?php
			}
			
			
		}										   
			
	}
	
	// --------------------------------------------------------------------
	
	function remove_dtr( $id = '' )
	{
		$this->Dtr->delete_by_id($id);
		
		echo 'Removed!';	
	}
	
}	