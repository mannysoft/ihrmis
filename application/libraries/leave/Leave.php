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
 * @copyright	Copyright (c) 2008 - 2014, Charliesoft
 * @license		http://charliesoft.net/ihrmis/license
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * iHRMIS Leave Class
 *
 * This class use for processing leave applications.
 *
 * @package		iHRMIS
 * @subpackage	Libraries
 * @category	Leave
 * @author		Manny Isles
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis/hrmis/user_guide/libraries/leave.html
 */
class Leave {

   	public $employee_id 		= '';
   	public $multiple 			= '';
	public $month 				= '';
	public $year  				= '';
	public $leave_type_id  		= '';
	public $month5  			= '';
	public $year5  				= '';
	public $multiple5  			= '';
	public $special_priv_id  	= '';
	public $days  				= '';
	public $mone  				= '';
	public $process  			= 0;
	public $date				= '';
	
	public $date_process 		= array();
	public $count_leave 		= 0;
	public $invalid 			= '';
	
	public $dates				= array();
	public $action_taken		= '';
	public $max_date			= '';
	public $min_date			= '';
	
	public $allow_sat_sun		= 0; // allow leave for saturday or sunday
								 // if set to 1 leave will allow the saturday and sunday
								 
	public $is_sat_sun			= '';
	public $is_holiday			= FALSE;
	public $is_half_day			= FALSE;
	
	public $period					= '';
	public $particulars				= '';
	public $v_earned				= 0;
	public $v_abs					= 0;
	public $v_balance				= 0;
	public $vacation_leave_balance	= 0;
	public $v_abs_wop				= 0;
	
	public $s_earned				= 0;
	public $s_abs					= 0;
	public $s_balance				= 0;
	public $sick_leave_balance		= 0;
	public $s_abs_wop				= 0;
	public $action_take				= '';
	public $sl_vsl					= FALSE;
	
    // ------------------------------------------------------------------------
   
    function __construct($params = array())
    {
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
		
		// Set to blank if the value is equal to zero
		$this->multiple 	= ($this->multiple == 0) ? '' : $this->multiple;
		$this->multiple5 	= ($this->multiple5 == 0) ? '' : $this->multiple5;
		$this->days 		= ($this->days == 0) ? '' : $this->days;
		$this->mone 		= ($this->mone == 0) ? '' : $this->mone;
		
	}
	
	// ------------------------------------------------------------------------
	
	function show_image($pics = '')
	{			
		if($pics == '')
		{
			$pics = 'not_available.jpg';
		}
		
		if (file_exists('pics/'.$pics))
		{
			list($width, $height) = getimagesize('pics/'.$pics);
		}
		else if (!file_exists('pics/'.$pics))
		{
			$pics = 'not_available.jpg';
			list($width, $height) = getimagesize('pics/'.$pics);
		}
		
		$w = $width/2;
		$h = $height/2;
		
		return '<center><img src="'.base_url().'pics/'.$pics.'" width="'.$w.'" height="'.$h.'" /></center><br>';
	}
	
	// ------------------------------------------------------------------------
	
	function is_employee($name = '')
	{
		$leave_type_id = $this->leave_type_id;
		
		$CI =& get_instance();
		
		if(count($name) != 0)
		{
			// Check what type of user is logged
			// If leave manager
			$CI->load->library('session');
			
			if ( $CI->session->userdata('user_type') == 5)
  			{
				// If the office is not equal to office id of user logged
				if ($CI->session->userdata('office_id') != $name['office_id'])
				{
					$lgu_code = $CI->Settings->get_selected_field('lgu_code'); 
					
					if ($lgu_code != 'bataraza')
					{
						echo '<font color="red">You are not allowed to view this records!</font>';
						return ;
					}
					
					
				}
				
			}
			
			
			$pics = $name['pics'];
			
			echo $this->show_image($pics);
			
			echo '<center><strong>'.$name['fname'].' '.$name['mname'].' '.$name['lname'].'</strong></center><br>';
			echo '<input name="taken" type="hidden" id="no_record" value="1" />';
			
			$total_leave = $CI->Leave_card->get_total_leave_credits($this->employee_id);

			$vbalance =  $total_leave['vacation'];
			$sbalance =  $total_leave['sick'];
			
			$total_leave_balance = $vbalance + $sbalance;
			
			$last_earn = $CI->Leave_card->get_last_earn($this->employee_id);
			
			$last_earn = ($last_earn != '') ? date('F d, Y', strtotime($last_earn)) : date('F d, Y');
			
			$this->leave_type_id = $leave_type_id;
			
			echo '<strong></strong> Leave Balances as of <b>'.$last_earn.'</b><br>';
			echo '<strong></strong> Vacation Leave Balance: <b>'.number_format($vbalance, 3).'</b><br>';
			echo '<strong></strong> Sick Leave Balance: <b>'.number_format($sbalance, 3).'</b><br>';
			echo '<strong></strong> Total Leave Balances: <b>'.number_format($total_leave_balance, 3).'</b><br>';
			echo '<strong></strong> MC#6 Balance: <b>'.$CI->Leave_card->get_mc_balance($this->employee_id, $this->year).'</b><br><br>';
			
			?>
			<br /><a href="#" onClick="openBrWindow('<?php echo base_url();?>leave_manage/leave_card/<?php echo $this->employee_id;?>','','scrollbars=yes,width=900,height=600')" style="cursor: pointer;">View Leave Card</a><br />
			<?php
		}
			
		else
		{
			echo '<center><strong>Enter a valid Employee ID</strong></center><br>';
			
			$value = 0;
			
			if($CI->session->userdata('employees') && is_array($CI->session->userdata('employees')))
			{
				$value = 1;
			}
			?>
			<input name="taken" type="hidden" id="no_record" value="<?php echo $value;?>" />
			<?php
		}
	}
	
	// ------------------------------------------------------------------------
	
	function multiple_months()
	{
		$CI =& get_instance();
		
		$more_dates = $CI->Helps->get_days_in_between($this->year. '-'.$this->month. '-'.$this->multiple, 
													  $this->year5.'-'.$this->month5.'-'.$this->multiple5);
															 
			
		$this->count_leave = 0;
		
		$this->date_process = '';
		
		foreach ($more_dates as $more_date)
		{
			list($year, $month, $day) = explode('-', $more_date);
			
			$this->is_sat_sun = $CI->Helps->is_sat_sun($month, $day, $year);
			
			$this->is_holiday = $CI->Holiday->is_holiday($more_date);
			
			$this->add_days($more_date);
		}
														 
		// Do this if to prevent error if the dates selected is sat or sun or holiday
		if ($this->count_leave != 0)
		{
			$this->dates = array_unique($this->date_process);
		}
	}
	
	// ------------------------------------------------------------------------
	
	function process_dates()
	{
		$CI =& get_instance();
				
		foreach ($this->dates as $date)
		{
			// ------------------------------------------------------------------------
			
			// If the date is like 25-26
			
			if (substr($date, 1, 1) == '-' or substr($date, 2, 1) == '-') 
			{
				// Get the minimum day and the maximum day of 25-26 (25-26 is the sample days)
				
				list($day1, $day2) = explode('-', $date);
				
				$dash_dates = $CI->Helps->get_days_in_between($this->year.'-'.$this->month.'-'.$day1, 
															  $this->year.'-'.$this->month.'-'.$day2);
			
				foreach ($dash_dates as $dash_date)
				{
					list($year45, $month45, $day45) = explode('-', $dash_date);
										
					$this->is_sat_sun = $CI->Helps->is_sat_sun($month45, $day45, $year45);
			
					$this->is_holiday = $CI->Holiday->is_holiday($dash_date);
					
					$this->is_half_day = FALSE;
					
					$this->add_days($dash_date);
				}
			}
			
			// ------------------------------------------------------------------------
			
			else // If the day has a 1 or 2 character
			{
				// ------------------------------------------------------------------------
				
				if (strlen($date) == 1 or strlen($date) == 2)
				{
					
					
					if (is_numeric($date))
					{
						$this->is_sat_sun = $CI->Helps->is_sat_sun($this->month, $date, $this->year);
			
						$this->is_holiday = $CI->Holiday->is_holiday($this->year.'-'.$this->month.'-'.$date);
						
						$this->is_half_day = FALSE;
						
						$this->add_days($this->year.'-'.$this->month.'-'.$date);
					}
					
				}
				
				// ------------------------------------------------------------------------
				
				// If the date is like 1am or 1pm or date is like 10am or 12pm
				if (strlen($date) == 3 or strlen($date) == 4)
				{
					
					$am_pm 	=  strtolower(substr($date, -2));
					
					// If 3 char
					if (strlen($date) == 3)
					{
						$day 	= substr($date, 0, 1);// get the 1 in string 1pm
					}
					// If 4 char
					else if (strlen($date) == 4)
					{
						$day = substr($date, 0, 2);// get the 12 in string 12pm
					}
					
					
					if (is_numeric($day) && ($am_pm == 'am' or $am_pm == 'pm') )
					{
						$this->is_sat_sun = $CI->Helps->is_sat_sun($this->month, $day, $this->year);
			
						$this->is_holiday = $CI->Holiday->is_holiday($this->year.'-'.$this->month.'-'.$day);
					
						$this->is_half_day = TRUE;
						
						$this->add_days($this->year.'-'.$this->month.'-'.$day.' '.$am_pm);
						
					}
					
				}
				
				// ------------------------------------------------------------------------
				
			}	
			
		}
	}
	
	// ------------------------------------------------------------------------
	
	function add_days($more_date)
	{
		$days = 1;
		
		if ($this->is_half_day == TRUE)
		{
			$days = 0.5;
		}
		
		if ($this->is_sat_sun == 'Saturday' or $this->is_sat_sun == 'Sunday' or $this->is_holiday == TRUE)
		{
			// If maternity add 1 day
			if ($this->leave_type_id == 5 or $this->leave_type_id == 20)
			{
				$this->count_leave += $days;
			}
			
			// If allow sat or sun
			if ( $this->allow_sat_sun == 1)
			{
				$this->date_process[] = $more_date;
				$this->count_leave += $days;
			}
		}
		else
		{
			$this->date_process[] = $more_date;
			$this->count_leave += $days;
			
			//echo $more_date.' -- '.$days.'<br>';
		}
	}
	
	// ------------------------------------------------------------------------
	
	function max_min_date()
	{
		if ( count($this->dates) > 0)
		{
			$max_date = max($this->dates);
			$max_date = explode(" ", $max_date);
			$this->max_date = $max_date[0];
			
			$min_date = min($this->dates);
			$min_date = explode(" ", $min_date);
			$this->min_date = $min_date[0];
		}
		
		if ($this->leave_type_id == 9)
		{
			$this->max_date 	= date('Y-m-d');
			$this->min_date 	= date('Y-m-d');
		}
	}
	
	// ------------------------------------------------------------------------
	
	function special_priv($drop_down = FALSE)
	{
		$special_priv = '';
		
		$special_privs = array(
						'1' => 'Personal Milestone',
						'2'	=> 'Parental Obligation',
						'3'	=> 'Filial Obligation',
						'4'	=> 'Domestic Emergency',
						'5'	=> 'Personal Transaction',
						'6'	=> 'Hospitalization',
						);
						
		return ($drop_down == TRUE) ? $special_privs : $special_privs[$this->special_priv_id];						
		//return $special_privs[$this->special_priv_id];
	}
	
	// ------------------------------------------------------------------------
	
	function process_leave_card()
	{
		$this->sl_vsl = FALSE; // Initialize to  FALSE to prevent from always TRUE
		
		$this->period 		= is_zero($this->period);
				
		$this->v_earned 	= is_zero($this->v_earned);
		
		// If MC#06
		if ($this->v_abs == 0 || $this->leave_type_id == 3)
		{
			$this->v_abs = '';
		}
		
		$this->v_abs_wop 	= is_zero($this->v_abs_wop);
		$this->s_earned 	= is_zero($this->s_earned);
				
		// If maternity, paternity or solo parent leave, mc2 s. 2012
		$leave_ids = array(4, 5, 6, 24);
		
		if ($this->s_abs == 0 || in_array($this->leave_type_id, $leave_ids))
		{
			$this->s_abs = '';
		}
		
		$this->s_abs_wop 		= is_zero($this->s_abs_wop);
		
		
		// balance here
		if ($this->v_balance != 0)
		{
			$this->vacation_leave_balance += $this->v_balance;
		}
		if ($this->s_balance != 0)
		{
			$this->sick_leave_balance += $this->s_balance;
		}
		
		// If the there is a file for vacation leave
		// Vacation leave balance minus the number of
		// vacation leave days filed. 
		if ($this->v_abs != 0)
		{
			$this->vacation_leave_balance -= $this->v_abs;
		}
		
		// Same as VL above
		if ($this->s_abs != 0)
		{
			$this->sick_leave_balance -= $this->s_abs;
		}
		
		// Earned
		if ($this->v_earned != 0)
		{
			$this->vacation_leave_balance += $this->v_earned;
		}
		if ($this->s_earned != 0)
		{
			$this->sick_leave_balance += $this->s_earned;
		}
		
		// Tell if the entry is leave forwarded
		$cut_particulars = substr($this->particulars, 0, 3);
		
		
		// If negative
		if (substr($this->sick_leave_balance, 0, 1) == '-')
		{
			
			// If balance forwarded
			if ($cut_particulars == 'Bal')
			{
			
			}
			else
			{
				// Do only if the entry is not earnings of leave and the entry is for sick leave
				// Do this if the application is sick leave
				if ($this->particulars != '' && $this->s_abs != 0)
				{
					
					$abs_sick_leave_balance = abs($this->sick_leave_balance);
					
					// If the leave application is greater than
					// negative balance
					if ($abs_sick_leave_balance > $this->s_abs)
					{
						
						$this->sick_leave_balance = $abs_sick_leave_balance - $this->s_abs;
						$this->sick_leave_balance = '-'.$this->sick_leave_balance;
						
						// If vacation leave balance is greater than
						// number of sick leave applied
						if($this->vacation_leave_balance > $this->s_abs)
						{
							$this->vacation_leave_balance = $this->vacation_leave_balance - $this->s_abs;
							$this->v_abs = $this->s_abs;
							$this->particulars = $this->v_abs.' VSL';
							
							// SL and VSL
							$this->sl_vsl = TRUE;
							
							$this->s_abs = '';
						}
						
						// If vacation leave balance is less than 
						// sick leave applied
						// make the w/out pay to sick leave
						if ($this->vacation_leave_balance < $this->s_abs)
						{
							$this->s_abs_wop = abs($this->s_abs);
							$this->s_abs = '';
							
						}
					}
					else
					{
						$this->s_abs_wop = abs($this->sick_leave_balance);
						$this->sick_leave_balance = 0;
						
						//echo $this->s_abs_wop;
						
						// vacation leave balance less sick leave wop
						$this->vacation_leave_balance -= $this->s_abs_wop;
						
						$s = $this->s_abs - $this->s_abs_wop;
						
						$this->particulars = $s.' SL, '.$this->s_abs_wop.' VSL';
						
						// SL and VSL
						$this->sl_vsl = TRUE;
						
						if ($s == 0)
						{
							$this->particulars = $this->s_abs_wop.' VSL';
							
							// SL and VSL
							$this->sl_vsl = TRUE;
						}
						
						$this->s_abs = $s;
						$this->v_abs = $this->s_abs_wop;
						
						$this->s_abs_wop = '';
					}
				}
				
			}
			
		}
		
		$this->is_vacation_negative();
		
		$this->is_terminal_leave();
		
	}
	
	// ------------------------------------------------------------------------
	
	function is_vacation_negative()
	{
		if (substr($this->vacation_leave_balance, 0, 1) == '-' && $this->v_abs != 0)
		{
			$this->v_abs_wop = abs($this->vacation_leave_balance);
						
			// If filed leave is greater than 
			if ($this->v_abs_wop > $this->v_abs)
			{
				$this->v_abs_wop = $this->v_abs;
			
				$this->vacation_leave_balance = abs($this->vacation_leave_balance) - $this->v_abs;
				$this->vacation_leave_balance = '-'.$this->vacation_leave_balance;
			}
			else
			{
				$this->vacation_leave_balance = 0;

				if ($this->sl_vsl == TRUE)
				{
					$this->s_abs_wop = $this->v_abs_wop;// updated 6.19.2012
					$this->v_abs_wop = '';
					
				}
				
			}
			
		}
	}	
	
	// ------------------------------------------------------------------------
	
	function is_terminal_leave()
	{
		if ( $this->leave_type_id == 21)
		{
			$this->vacation_leave_balance 	= 0;
			$this->sick_leave_balance 		= 0;
		}
	}
	
	// ------------------------------------------------------------------------
	
}
