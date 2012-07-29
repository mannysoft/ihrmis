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
class Leave_card extends CI_Model {

	// --------------------------------------------------------------------
	
	var $fields = array();
	
	// --------------------------------------------------------------------
	
	/**
	 * Constructor
	 *
	 * @return Leave_card
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Add new leave card entry
	 *
	 * @param array $data
	 * @return int
	 */
	function add_leave_card($data)
	{
		$id = $this->db->insert('leave_card', $data);
		
		return $this->db->insert_id();
	}
	
	// --------------------------------------------------------------------
	
	function cancel_undertime($id = '')
	{
		$this->db->where('id', $id);
		$this->db->delete('leave_card');
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Delete balance forwarded depending on employee.
	 * 
	 *
	 * @param varchar $employee_id
	 */
	function delete_balance_forwarded($employee_id)
	{
		$this->db->where('employee_id', $employee_id);
		
		$this->db->like('particulars', 'bal','both');	 	 
		
		$this->db->delete('leave_card');
	}
	
	// --------------------------------------------------------------------
	
	function delete_earning($employee_id, $first_day, $stop_date)
	{
		$this->db->where('employee_id', $employee_id);
		
		$this->db->where('period !=', '0000-00-00');
		
		$this->db->where("period BETWEEN '$first_day' AND '$stop_date'");
		
		$this->db->delete('leave_card');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Delete all entries in leave card where 
	 * less than the date the leave forward
	 *
	 * @param varchar $employee_id
	 * @param string(date) $date_cutoff
	 */
	function delete_less_forwarded($employee_id, $date_cutoff)
	{
		$this->db->where('employee_id', $employee_id);
		
		$this->db->where('date <=', $date_cutoff);	 	 
		
		$this->db->delete('leave_card');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Delete the undertime entry in leave card
	 *
	 * @param varchar $employee_id
	 * @param string(date) $date
	 */
	function delete_undertime($employee_id, $date)
	{
		$this->db->where('employee_id', $employee_id);
		$this->db->where('date', $date);
		$this->db->where('period', '0000-00-00');
		$this->db->where('leave_type_id', 0);	 	 
		
		$this->db->delete('leave_card');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Delete the pass slip entry in leave card
	 *
	 * @param varchar $employee_id
	 * @param string(date) $date
	 */
	function delete_pass_slip($employee_id, $pass_slip_date)
	{
		$this->db->where('employee_id', $employee_id);
		$this->db->where('pass_slip_date', $pass_slip_date);
		$this->db->where('particulars', 'Pass Slip');
		
		$this->db->delete('leave_card');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get the leave card entries by employee id specified.
	 * Only active entries will return
	 *
	 * @param varchar $employee_id
	 * @return array
	 */
	function get_card($employee_id)
	{
		$rows = array();
		
		$this->db->select($this->fields);
		
		$this->db->where('employee_id', $employee_id);
		$this->db->where('enabled', 1);
		$this->db->order_by('date, period');
		$q = $this->db->get('leave_card');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$rows[] = $row;	
			}
		}
		
		return $rows;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	// Get the file leave
	function get_encoded_card($employee_id)
	{
		$rows = array();
		
		$this->db->select($this->fields);
		
		$this->db->where('employee_id', $employee_id);
		//$this->db->where('enabled', 1);
		$this->db->where('manual_log_id !=', 0);
		$this->db->order_by('date', 'DESC');
		$q = $this->db->get('leave_card');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$rows[] = $row;	
			}
		}
		
		return $rows;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get forced leave balance minus 5.
	 * Since 5 forced leave allowed per year
	 *
	 * @param varchar $employee_id
	 * @param int $year
	 * @return double
	 */
	function get_forced_balance($employee_id, $year)
	{
		$data = 0;
		
		$this->db->select('SUM(v_abs) as forced');
		$this->db->where('employee_id', $employee_id);
		$this->db->where('leave_type_id', 7);
		$this->db->where('YEAR(date)', $year);
		
		$q = $this->db->get('leave_card');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row['forced'];	
			}
		}
	
		return 5 - $data;
		
		$q->free_result();
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get the date of last earning of leave of
	 * employee.
	 *
	 * @param varchar $employee_id
	 * @return string(date)
	 */
	function get_last_earn($employee_id)
	{
		$data = '';
		
		$this->db->select('MAX(period) as period');
		$this->db->where('employee_id', $employee_id);
		
		$q = $this->db->get('leave_card');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row['period'];	
			}
		}
		
		//echo $data;
		
		return $data;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get total mc leave balance
	 *
	 * @param varchar $employee_id
	 * @param int $year
	 * @return double
	 */
	function get_mc_balance($employee_id, $year)
	{
		$total_mc = 0;
		
		$this->db->select('sum( v_abs ) AS total_mc');
		$this->db->where('employee_id', $employee_id);
		$this->db->where('YEAR(date)', $year);
		$this->db->where('leave_type_id', 3);
		$q = $this->db->get('leave_card');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$total_mc = $row['total_mc'];
			}
		}
		
		return 3 - $total_mc;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get total leave credits of employee
	 *
	 * @param varchar $employee_id
	 * @return array
	 */
	function get_total_leave_credits($employee_id)
	{
		$cards = $this->get_card($employee_id);
		
		$vacation_leave_balance = 0;
		$sick_leave_balance 	= 0;
		
		// --------------------------------------------------------------------
		
		foreach ($cards as $card)
		{
			$period 		= $card['period'];
			$particulars 	= $card['particulars'];
			$v_earned 		= $card['v_earned'];
			$v_abs 			= $card['v_abs'];
			$v_balance 		= $card['v_balance'];
			$v_abs_wop 		= $card['v_abs_wop'];
			
			$s_earned 		= $card['s_earned'];
			$s_abs 			= $card['s_abs'];
			$s_balance 		= $card['s_balance'];
			$s_abs_wop 		= $card['s_abs_wop'];
			
			$action_taken 	= $card['action_take'];
			$date 			= $card['date'];
			
			if($period == '0000-00-00')
			{
				$period = '';
			}
			if($v_earned == 0)
			{
				$v_earned = '';
			}
			if ($v_abs == 0 || $card['leave_type_id'] == 3)//MC6
			{
				$v_abs = '';
			}
			if ($v_abs_wop == 0)
			{
				$v_abs_wop = '';
			}
			
			if($s_earned == 0)
			{
				$s_earned = '';
			}
			if ($s_abs == 0 || $card['leave_type_id'] == 4 || $card['leave_type_id'] == 5 || $card['leave_type_id'] == 6)
			{
				$s_abs = '';
			}
			if ($s_abs_wop == 0)
			{
				$s_abs_wop = '';
			}
			
			
			// balance here
			if ($v_balance != 0)
			{
				$vacation_leave_balance += $v_balance;
			}
			if ($s_balance != 0)
			{
				$sick_leave_balance += $s_balance;
			}
			
			if ($v_abs != 0)
			{
				$vacation_leave_balance -= $v_abs;
			}
			if ($s_abs != 0)
			{
				//echo $s_abs;
				$sick_leave_balance -= $s_abs;
			}
			
			// earned
			if ($v_earned != 0)
			{
				$vacation_leave_balance += $v_earned;
			}
			if ($s_earned != 0)
			{
				$sick_leave_balance += $s_earned;
			}
			
			// tel if the entry is leave forwarded
			$cut_particulars = substr($particulars, 0, 3);
			
			
			// --------------------------------------------------------------------
			
			// if negative
			if (substr($sick_leave_balance, 0, 1) == '-')
			{
				
				// if balance forwarded
				if ($cut_particulars == 'Bal')
				{
				
				}
				else
				{
					// do only if the entry is not earnings of leave and the entry is for sick leave
					// do this if the application is sick leave
					if ($particulars != '' && $s_abs != 0)
					{
						
						$abs_sick_leave_balance = abs($sick_leave_balance);
						
						// if the leave application is greater than
						// negative balance
						if ($abs_sick_leave_balance > $s_abs)
						{
							
							$sick_leave_balance = $abs_sick_leave_balance - $s_abs;
							$sick_leave_balance = '-'.$sick_leave_balance;
							
							// if vacation leave balance is greater than
							// number of sick leave applied
							if($vacation_leave_balance > $s_abs)
							{
								$vacation_leave_balance = $vacation_leave_balance - $s_abs;
								$v_abs = $s_abs;
								$particulars = $v_abs.' VSL';
								
								$s_abs = '';
							}
							
							// if vacation leave balance is less than 
							// sick leave applied
							// make the w/out pay to sick leave
							if ($vacation_leave_balance < $s_abs)
							{
								$s_abs_wop = abs($s_abs);
								$s_abs = '';
							}
						}
						else
						{
							$s_abs_wop = abs($sick_leave_balance);
							$sick_leave_balance = 0;
							
							// vacation leave balance less sick leave wop
							$vacation_leave_balance -= $s_abs_wop;
							
							$s = $s_abs - $s_abs_wop;
							
							$particulars = $s.' SL, '.$s_abs_wop.' VSL';
							
							if ($s == 0)
							{
								$particulars = $s_abs_wop.' VSL';
							}
							
							$s_abs = $s;
							$v_abs = $s_abs_wop;
							
							$s_abs_wop = '';
						}
					}
					
				}
				
				// update entry
			}
			
			// --------------------------------------------------------------------
			
			
			if (substr($vacation_leave_balance, 0, 1) == '-' && $v_abs != 0)
			{
				$v_abs_wop = abs($vacation_leave_balance);
				
				
				if ($v_abs_wop > $v_abs)
				{
					$v_abs_wop = $v_abs;
					$vacation_leave_balance = abs($vacation_leave_balance) - $v_abs;
					$vacation_leave_balance = '-'.$vacation_leave_balance;
				}
				else
				{
					$vacation_leave_balance = 0;
				}
				// update entry
			}
			
			// 6.15.2011 5.51pm == ======= == = 
			if ( $card['leave_type_id'] == 21)
			{
				$vacation_leave_balance = 0;
				$sick_leave_balance 	= 0;
			}
			
			//echo $sick_leave_balance.'--'.$s_abs.'<br>';
			
			// == = == = == = = = =========== =
		}	
		
		// --------------------------------------------------------------------
			
			
		$credits['vacation']				= $vacation_leave_balance;
		$credits['sick'] 					= $sick_leave_balance;
		
		$credits['mc'] 						= $this->get_mc_balance($employee_id, date('Y'));
		$credits['forced'] 					= $this->get_forced_balance($employee_id, date('Y'));
		$credits['last_earn']			 	= $this->get_last_earn($employee_id);
		
		$this->Employee->fields = array(
										'id',
										'first_day_of_service', 
										'salut', 
										'fname', 
										'mname', 
										'lname',
										'office_id',
										'salary_grade',
										'step'
										);
		
		$name = $this->Employee->get_employee_info($employee_id);
		
		$office = $this->Office->get_office_info($name['office_id']);
		
		// We need to check what salary grade the office use
		if ( $office['salary_grade_type'] == 'hospital' )
		{
			$this->Salary_grade->salary_grade_type = 'hospital';
		}
		
		$grand_total = $this->Salary_grade->monetary_equivalent(
							$name['salary_grade'], 
							$name['step'], 
							$sick_leave_balance, 
							$vacation_leave_balance
							);
		
		//$credits['monetary_equivalent'] 	= $this->Leave_balance->get_monetary($employee_id);
		
		$credits['monetary_equivalent'] 	= $grand_total;
		
		return $credits;
		
	}
	
	
	// --------------------------------------------------------------------
	
	/**
	 * Get total leave earnings
	 *
	 * @param varchar $employee_id
	 * @return array
	 */
	function get_total_leave_earned($employee_id, $year)
	{
		$data = array();
		
		$this->db->select("SUM(v_earned) as sum_vacation, 
							SUM(s_earned) AS sum_sick");
							
		$this->db->where('employee_id', $employee_id);
		
		$this->db->where('YEAR(period)', $year);
		
		$this->db->where('enabled', 1);
		
		$q = $this->db->get('leave_card');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row;
			}
		}
		
		return $data;
		
		$q->free_result();
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get total leave spent
	 *
	 * @param varchar $employee_id
	 * @return array
	 */
	function get_total_leave_spent($employee_id, $year)
	{
		$data = array();
		
		$this->db->select("SUM(v_abs) AS vacation_spent, 
							SUM(s_abs) AS sick_spent");
							
		$this->db->where('employee_id', $employee_id);
		$this->db->where('enabled', 1);
		
		// Not SPL
		$this->db->where('leave_type_id !=', 3);
		
		//$this->db->where('YEAR(period)', $year);
		$this->db->where('YEAR(date)', $year);
		
		$q = $this->db->get('leave_card');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row;
			}
		}
		
		return $data;
		
		$q->free_result();
		
	}
	
	// --------------------------------------------------------------------
	
	// Get the undertime leave
	function get_undertime($employee_id)
	{
		$rows = array();
		
		$this->db->select($this->fields);
		$this->db->where('employee_id', $employee_id);
		$this->db->like('action_take', 'Undertime', 'both');
		$this->db->order_by('date', 'DESC');
		$q = $this->db->get('leave_card');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$rows[] = $row;	
			}
		}
		
		return $rows;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Insert entry
	 *
	 * @param varchar $employee_id
	 * @param string $particulars
	 * @param double $v_abs
	 * @param string $action_take
	 * @param string(date) $date
	 */
	function insert_entry($employee_id, $particulars, $v_abs, $action_take, $date, $enabled = 0, $pass_slip_date = '' )
	{
		$data = array(
					"employee_id"		=> $employee_id,
					"particulars"		=> $particulars,
					"v_abs"				=> $v_abs,
					"action_take" 		=> $action_take,
					"date"				=> $date,
					"enabled"			=> $enabled,
					'pass_slip_date' 	=> $pass_slip_date
					);
				
		$id = $this->db->insert('leave_card', $data);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Tells whether an entry exists
	 *
	 * @param varchar $employee_id
	 * @param string $action_take
	 * @return boolean
	 */
	function is_entry_exists($employee_id, $action_take)
	{
		$this->db->select('id');
		$this->db->where('employee_id', $employee_id);
		$this->db->where('action_take', $action_take);
		$q = $this->db->get('leave_card');
		
		if ($q->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
		$q->free_result();
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Earn the leave credits
	 * This will automatically execute every last day of the month
	 * 
	 * It may happen that the last day of the month is saturday or sunday,
	 * We can earned the leave credits manually by clicking button on the 
	 * home page
	 *
	 * @param string $month
	 * @param string $year
	 */
	function process_leave_earnings($month, $year, $leave_earn = '')
	{
		$rows = $this->Employee->get_permanent();
		
		$last_day 			= $this->Helps->get_last_day($month, $year);
		
		$last_day 			= $year.'-'.$month.'-'.$last_day;
		
		$rows 				= $this->Employee->get_permanent();
		
		// --------------------------------------------------------------------
		
		// if 15/30
		if ($leave_earn == 15 || $leave_earn == 30)
		{
			if ($leave_earn == 15)
			{
				foreach($rows as $row)
				{
					$id 		= $row['employee_id'];
					$office_id  = $row['office_id'];
					
					// Add to leave card table
					$data = array(
								"employee_id"	=> $id,
								"period" 		=> $year.'-'.$month.'-15',
								"v_earned" 		=> 0.625, 
								"s_earned" 		=> 0.625,
								"date"			=> $year.'-'.$month.'-15'
								);
								
					$this->add_leave_card($data);			
					
				}
				
				// Done leave earnings
				$this->Leave_earn_sched->set_done($month, $year, 'done');
				
				return 0;
				
			}
			
			if ($leave_earn == 30)
			{
				foreach($rows as $row)
				{
					$id 		= $row['employee_id'];
					$office_id  = $row['office_id'];
					
					// Add to leave card table
					$data = array(
								"employee_id"	=> $id,
								"period" 		=> $last_day,
								"v_earned" 		=> 0.625, 
								"s_earned" 		=> 0.625,
								"date"			=> $last_day
								);
								
					$this->add_leave_card($data);		
					
				}
				
				// Done leave earnings
				$this->Leave_earn_sched->set_done($month, $year, 'done2');
				
				return 0;
				
			}
			
		}
		
		// --------------------------------------------------------------------
		// If every end of the month.
		
		foreach($rows as $row)
		{
			$id 		= $row['employee_id'];
			$office_id  = $row['office_id'];
			
			// Add to leave card table
			$data = array(
								"employee_id"	=> $id,
								"period" 		=> $last_day,
								"v_earned" 		=> 1.25, 
								"s_earned" 		=> 1.25,
								"date"			=> $last_day
								);
								
			$this->add_leave_card($data);		
		}
		
		// Done leave earnings
		$this->Leave_earn_sched->set_done($month, $year, 'done');
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Set the leave card entry enabled/disabled
	 *
	 * @param string(date) $last_day
	 * @param int $enabled
	 */
	function set_enabled($last_day, $enabled = 1)
	{	
		$data = array(
					'enabled' => $enabled,
					);
		
		$this->db->like('particulars', 'UT', 'after');
		$this->db->where('date', $last_day);
		$this->db->update('leave_card', $data); 	
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Update leave card entries
	 *
	 * @param varchar $employee_id
	 * @param string $particulars
	 * @param doube $v_abs
	 * @param string $action_take
	 * @param string(date) $date
	 */
	function update_entry($employee_id, $particulars, $v_abs, $action_take, $date, $enabled = 0)
	{
		$data = array(
               'particulars' => $particulars,
               'v_abs' 		 => $v_abs,
               'action_take' => $action_take,
			   'date' 		 => $date,
			   'enabled'	 => $enabled
            );

		$this->db->where('employee_id', $employee_id);
		$this->db->where('action_take', $action_take);
		$this->db->update('leave_card', $data); 
	}
	
}	

/* End of file leave_card.php */
/* Location: ./application/models/leave_card.php */