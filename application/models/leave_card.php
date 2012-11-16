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
class Leave_card extends CI_Model {

	// --------------------------------------------------------------------
	
	public $fields = array();
	
	public $encoded_leave_listing_order = 'DESC';
	
	public $period 			= '';
	public $particulars 	= '';
	public $v_earned 		= '';
	public $v_abs 			= '';
	public $v_balance 		= '';
	public $v_abs_wop 		= '';
	public $s_earned 		= '';
	public $s_abs 			= '';
	public $s_balance 		= '';
	public $s_abs_wop 		= '';
	public $action_taken 	= '';
	public $date 			= '';
	
	// --------------------------------------------------------------------
	
	/**
	 * Constructor
	 *
	 * @return Leave_card
	 */
	function __construct($params = array())
	{
		parent::__construct();
		
		if (count($params) > 0)
		{
			$this->initialize($params);
		}
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Initialize Preferences
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 * @return	void
	 */
	function initialize($params = array())
	{
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->$key))
				{
					$this->$key = $val;
				}
			}
		}		
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
	 * Count the number of VL spent by employee id and year
	 * specified.
	 * 
	 *
	 * @param varchar $employee_id
	 * @param varchar $year
	 * @return array
	 */
	function count_vl_spent($employee_id, $year)
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
		
		$this->db->where('period !=', '');
		
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
		$this->db->where('period', '');
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
	function get_card($employee_id, $record_limit_date = '')
	{
		$rows = array();
		
		$this->db->select($this->fields);
		
		$this->db->where('employee_id', $employee_id);
		$this->db->where('enabled', 1);

		// Added 10.4.2012 11.22am
		if ($record_limit_date != '') 
		{
			$this->db->where('date <=', $record_limit_date);
		}

		//$this->db->order_by('date, period'); old order by
		$this->db->order_by('date, period DESC'); // change 5.3.2012
		$q = $this->db->get('leave_card');
		
		//echo $this->db->last_query();
		
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
		
		$this->load->model('Settings');
				
		//$this->db->order_by('date', 'DESC'); //ORIG
		
		$this->db->order_by('date', $this->encoded_leave_listing_order);
		
		
		$q = $this->db->get('leave_card');
		
		//echo date('Y m d');
		
		//echo $this->db->last_query();
		
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
	 * Get the date of last leave being filed of
	 * the employee.
	 *
	 * @param varchar $employee_id
	 * @return string(date)
	 */
	function get_last_leave_filed($employee_id)
	{
		$data = '';
		
		$this->db->select_max('date');
		$this->db->where('employee_id', $employee_id);
		
		$q = $this->db->get('leave_card');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row['date'];
			}
		}
		
		//echo $this->db->last_query();
				
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
	function get_total_leave_credits($employee_id, $record_limit_date = '')
	{
		$cards = $this->get_card($employee_id, $record_limit_date);
		
		// --------------------------------------------------------------------
		$this->load->helper('text');
		$this->load->library('leave/leave');
		
		$this->leave->vacation_leave_balance 	= 0;
		$this->leave->sick_leave_balance 		= 0;
		
		foreach ($cards as $card)
		{
			$this->leave->initialize($card);
			$this->leave->process_leave_card();
		}	
		
		// --------------------------------------------------------------------
			
		$credits['vacation']				= $this->leave->vacation_leave_balance;
		$credits['sick'] 					= $this->leave->sick_leave_balance;
		
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
							$this->leave->sick_leave_balance, 
							$this->leave->vacation_leave_balance
							);
				
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
	 * Tells whether an entry of leave earn exists
	 *
	 * @param array $data
	 * @return boolean
	 * @since version 2.00.00
	 */
	function is_leave_earn_exists($data = array())
	{
		$this->db->select('id');
		$this->db->where('employee_id', $data['employee_id']);
		$this->db->where('period', $data['period']);
		$this->db->where('v_earned', $data['v_earned']);
		$this->db->where('s_earned', $data['s_earned']);
		$this->db->where('date', $data['date']);
		$q = $this->db->get('leave_card', 1);
		
		if ($q->num_rows() > 0)
		{
			return TRUE;
		}
		
		return FALSE;
		
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
	 * @param string $leave_earn
	 */
	function process_leave_earnings($month, $year, $leave_earn = '')
	{
		$rows = $this->Employee->get_permanent();
		
		$last_day 			= $this->Helps->get_last_day($month, $year);
		
		$last_day 			= $year.'-'.$month.'-'.$last_day;
		
		$rows 				= $this->Employee->get_permanent();
		
		// --------------------------------------------------------------------
		// Updated 06072012 
		// Theres a problem when earning the leave id leave_earn == 30
		$leave_earn_sched =  $this->Settings->get_selected_field('leave_earn');
		
		// if 15/30
		//if ($leave_earn == 15 || $leave_earn == 30)
		if (($leave_earn == 15 || $leave_earn == 30) and $leave_earn_sched == 15)
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
					
					// Lets check if the leave earning exist 
					// before we insert another one.
					
					$is_leave_earn_exists = $this->is_leave_earn_exists($data);
					
					if ($is_leave_earn_exists == FALSE)
					{
						$this->add_leave_card($data);
					}
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
								
					// Lets check if the leave earning exist 
					// before we insert another one.
					
					$is_leave_earn_exists = $this->is_leave_earn_exists($data);
					
					if ($is_leave_earn_exists == FALSE)
					{
						$this->add_leave_card($data);
					}					
				}
				
				//echo '30';
				//exit;
				
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
											
			// Lets check if the leave earning exist 
			// before we insert another one.
			
			$is_leave_earn_exists = $this->is_leave_earn_exists($data);
			
			if ($is_leave_earn_exists == FALSE)
			{
				$this->add_leave_card($data);
			}	
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