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
 * @author		Manolito Isles
 * @copyright	Copyright (c) 2008 - 2013, Charliesoft
 * @license		http://charliesoft.net/ihrmis/license
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
class Stand_alone extends CI_Model {

	// --------------------------------------------------------------------
	
	/**
	 * Constructor
	 *
	 * @return Stand_alone
	 */
	function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler(TRUE);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Change status if delete is enable
	 *
	 * @param unknown_type $status
	 */
	function change_delete_status($status)
	{
		$file = 't4_connect/logs/delete_logs.txt';
		$fh = fopen($file, 'w') or die("can't open file");
		fwrite($fh, $status);
		fclose($fh);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Change the IP address of the machine 
	 *
	 * @param file $file
	 * @param string $ip
	 */
	function change_ip($file, $ip)
	{
		$fh = fopen($file, 'w') or die("can't open file");
		fwrite($fh, $ip);
		fclose($fh);

	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Change the method to use in T4 machines
	 * Whether to use com or net
	 *
	 * @param unknown_type $file
	 * @param unknown_type $ip
	 */
	function change_method($file, $method)
	{
		$fh = fopen($file, 'w') or die("can't open file");
		fwrite($fh, $method);
		fclose($fh);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get the curent IP
	 *
	 * @return string
	 */
	function current_ip()
	{
		$ip = file_get_contents('t4_connect/logs/ip.txt', true);
		return trim($ip);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get the logs from temporary table
	 *
	 */
	function get_logs()
	{
		//delete dtr temp
		$this->Dtr_temp->delete_dtr_temp();
		
		$rows = $this->Dtr_temp->get_dtr_temp();
		
		//echo print_r($rows);
		// set the pm_logout_temp to blank
		$am_logout_temp = '';
		$old_date = '';
		
		
		// --------------------------------------------------------------------
		foreach ($rows as $row)
		{
			$id 			= $row['id'];
			$employee_id 	= $row['employee_id'];
			$office_id 		= $row['office_id'];
			$log_date 		= $row['log_date'];
			$logs 			= $row['logs'];
			$log_type 		= $row['log_type'];
			$date_extract 	= $row['date_extract'];
			
			// if the date is not the same as the previous date that process
			if ($old_date != $log_date)
			{
				$am_logout_temp = '';
				$old_date = $log_date;
			}
			
			$office_id = $this->Employee->get_single_field('office_id', $employee_id);
			
			// Check if log exists
			$log_exist	= $this->Dtr->is_log_date_exists($employee_id, $log_date);
			
			//====================================================================================
			// If AM
			if ($logs < '12:00' )
			{
				// IF IN
				if ($log_type == 0)
				{
					$field = 'am_login';
					
					// If exists
					if ($log_exist == TRUE)
					{
						// Update
						//$this->update_dtr($employee_id, $log_date, $logs, $field);
						
						$data = array('am_login' => $logs);
						
						$this->Dtr->edit_dtr($data, $employee_id, $log_date);
					}
					else
					{
						
						// INSERT
						//$this->insert_dtr($employee_id, $office_id, $log_date, $logs, $field);
						
						$data = array(
									'employee_id' 	=> $employee_id,
									'am_login' 		=> $logs,
									'office_id' 	=> $office_id,
									'log_date' 		=> $log_date
									);
						
						$this->Dtr->insert_dtr($data);
					}
				}
				
				
				// IF OUT
				if ($log_type == 1)
				{
					$field = 'am_logout';
					// If exists
					if ($log_exist == TRUE)
					{
						// Update
						//$this->update_dtr($employee_id, $log_date, $logs, $field);
						
						$data = array('am_logout' => $logs);
						
						$this->Dtr->edit_dtr($data, $employee_id, $log_date);
					}
					else
					{
						
						// INSERT
						//$this->insert_dtr($employee_id, $office_id, $log_date, $logs, $field);
						
						$data = array(
									'employee_id' 	=> $employee_id,
									'am_logout' 	=> $logs,
									'office_id' 	=> $office_id,
									'log_date' 		=> $log_date
									);
						
						$this->Dtr->insert_dtr($data);
					}
				}
			
			}
			// --------------------------------------------------------------------
			// if PM
			if ($logs >= '12:00' )
			{
				// IF IN
				if ($log_type == 0)
				{
					$field = 'pm_login';
					
					// If exists
					if ($log_exist == TRUE)
					{
						// Update
						//$this->update_dtr($employee_id, $log_date, $logs, $field);
						
						$data = array('pm_login' => $logs);
						
						$this->Dtr->edit_dtr($data, $employee_id, $log_date);
					}
					else
					{
						
						// INSERT
						//$this->insert_dtr($employee_id, $office_id, $log_date, $logs, $field);
						$data = array(
									
									'employee_id' 	=> $employee_id,
									'pm_login' 		=> $logs,
									'office_id' 	=> $office_id,
									'log_date' 		=> $log_date
									);
						
						$this->Dtr->insert_dtr($data);
					}
				}
				// --------------------------------------------------------------------
				// IF OUT
				if ($log_type == 1)
				{
					if ($am_logout_temp != '')
					{
						$am_logout = $am_logout_temp;
						$pm_logout = $logs;
						
						// If exists
						if ($log_exist == TRUE)
						{
							// Update
							//$this->update_dtr($employee_id, $log_date, $am_logout, 'am_logout');
							//$this->update_dtr($employee_id, $log_date, $pm_logout, 'pm_logout');
							
							$data = array('am_logout' => $am_logout);
						
							$this->Dtr->edit_dtr($data, $employee_id, $log_date);
							
							$data = array('pm_logout' => $pm_logout);
						
							$this->Dtr->edit_dtr($data, $employee_id, $log_date);
						}
						else
						{
							
							// INSERT
							//$this->insert_dtr($employee_id, $office_id, $log_date, $am_logout, 'am_logout');
							//$this->insert_dtr($employee_id, $office_id, $log_date, $pm_logout, 'pm_logout');
							
							$data = array(
									'employee_id' 	=> $employee_id,
									'am_logout' 	=> $am_logout,
									'office_id' 	=> $office_id,
									'log_date' 		=> $log_date
									);
						
							$this->Dtr->insert_dtr($data);
							
							$data = array(
									'employee_id' 	=> $employee_id,
									'pm_logout' 	=> $pm_logout,
									'office_id' 	=> $office_id,
									'log_date' 		=> $log_date
									);
						
							$this->Dtr->insert_dtr($data);
						}
						
						// Turn back the value of $am_logout_temp to blank
						$am_logout_temp = '';
					}
					else
					{
						$am_logout_temp = $logs;
						
						// The fields in the following if statement 
						// should change to pm_logout for the of 8 hrs straight in the hospitals
						//
						// If exists
						if ($log_exist == TRUE)
						{
							//Update
							//$this->update_dtr($employee_id, $log_date, $logs, 'am_logout');
							
							$data = array('am_logout' => $logs);
						
							$this->Dtr->edit_dtr($data, $employee_id, $log_date);
						}
						else
						{
							// INSERT
							//$this->insert_dtr($employee_id, $office_id, $log_date, $logs, 'am_logout');
							$data = array(
									'employee_id' 	=> $employee_id,
									'am_logout' 	=> $logs,
									'office_id' 	=> $office_id,
									'log_date' 		=> $log_date
									);
						
							$this->Dtr->insert_dtr($data);
						}
						
					}
					
				}// --------------------------------------------------------------------
				
			}// --------------------------------------------------------------------
			

		}
		// --------------------------------------------------------------------
		
		//DELETE ALL LOGS from dtr_temp
		//mysql_query('TRUNCATE TABLE ats_dtr_temp') or die(mysql_error());
		$this->db->truncate('dtr_temp'); 

	}
	
}	

/* End of file stand_alone.php */
/* Location: ./application/models/stand_alone.php */