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
 * iHRMIS Compensatory Timeoff Class
 *
 * This class use for processing compensatory timeoff applications.
 *
 * @package		iHRMIS
 * @subpackage	Libraries
 * @category	Leave
 * @author		Manolito Isles
 * @link		http://charliesoft.net/hrmis/user_guide/libraries/cto.html
 */
class Cto {

   	public $employee_id 		= '';
   	public $multiple 			= '';
	public $month 				= '';
	public $year  				= '';
	public $process  			= 0;
	
	public $date_process 		= array();
	public $count_leave 		= 0;
	public $invalid 			= '';
	
	public $dates				= array();
	public $action_taken		= '';
	public $max_date			= '';
	
	public $allow_sat_sun		= 0; // allow leave for saturday or sunday
								 // if set to 1 leave will allow the saturday and sunday
   
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
		
	}
	
	// ------------------------------------------------------------------------
	
	function is_employee($name = '')
	{
		$CI =& get_instance();
		
		if(count($name) != 0)
		{
			$pics = $name['pics'];
			
			$CI->load->library('leave/leave');
			
			echo $CI->leave->show_image($pics);
			
			echo '<center><strong>'.$name['fname'].' '.$name['mname'].' '.$name['lname'].'</strong></center><br>';
			echo '<input name="taken" type="hidden" id="no_record" value="1" />';
			
			//=========
			$total_leave = $CI->Leave_card->get_total_leave_credits($this->employee_id);
			
			$vbalance =  $total_leave['vacation'];
			$sbalance =  $total_leave['sick'];
			//==========
			
			$total_leave_balance = $vbalance + $sbalance;
			
			$last_earn = $CI->Leave_card->get_last_earn($this->employee_id);
			
			$last_earn = ($last_earn != '') ? date('F d, Y', strtotime($last_earn)) : date('F d, Y');
							
			?>
			<br />View Compensatory Timeoff Card <img src="<?php echo base_url();?>images/classevent_main.png" title="History" onClick="openBrWindow('<?php echo base_url();?>leave_manage/leave_card/<?php echo $this->employee_id;?>','','scrollbars=yes,width=900,height=600')" style="cursor: pointer;"/><br />
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
	
	function process_dates()
	{
		$CI =& get_instance();
		
		foreach ($this->dates as $date)
		{
			// If the date is like 25-26
			
			if (substr($date, 1, 1) == '-' or substr($date, 2, 1) == '-') 
			{
				// Get the minimum day and the maximum day of 25-26 (25-26 is the sample days)
				
				list($day1, $day2) = explode('-', $date);
				
				$dash_dates = $CI->Helps->get_days_in_between($this->year.'-'.$this->month.'-'.$day1, 
															  $this->year.'-'.$this->month.'-'.$day2);
			
				foreach ($dash_dates as $dash_date)
				{
					//list($year45, $month45, $day45) = split('[-.-]', $dash_date);
					list($year45, $month45, $day45) = explode('-', $dash_date);
					
					$is_sat_sun = $CI->Helps->is_sat_sun($month45, $day45, $year45);
					
					$is_holiday = $CI->Holiday->is_holiday($dash_date);
					
					
					// If maternity add 1 day
					if ( ($is_sat_sun == 'Saturday' or $is_sat_sun == 'Sunday' or $is_holiday == TRUE) && $this->leave_type_id == 5)
					{
						$this->count_leave += 1;
					}
					
					if ($is_sat_sun == 'Saturday' or $is_sat_sun == 'Sunday' or $is_holiday == TRUE)
					{
						// If allow sat or sun
						if ( $this->allow_sat_sun == 1)
						{
							$this->date_process[] = $dash_date;
							$this->count_leave += 1;
						}
					}
					else
					{
						$this->date_process[] = $dash_date;
						$this->count_leave += 1;
						
					}
					
					
				}
			}
			else // If the day has a 1 or 2 character
			{
				if (strlen($date) == 1 or strlen($date) == 2)
				{
					
					if (is_numeric($date))
					{
						$is_sat_sun = $CI->Helps->is_sat_sun($this->month, $date, $this->year);
					
						$is_holiday = $CI->Holiday->is_holiday($this->year.'-'.$this->month.'-'.$date);
						
						if ($is_sat_sun == 'Saturday' or $is_sat_sun == 'Sunday' or $is_holiday == TRUE)
						{
							
							// If allow sat or sun
							if ( $this->allow_sat_sun == 1)
							{
								$this->date_process[] = $this->year.'-'.$this->month.'-'.$date;
								$this->count_leave += 1;
							}
						}
						else
						{
							$this->date_process[] = $this->year.'-'.$this->month.'-'.$date;
							$this->count_leave += 1;
						}
						
					}
					
				}
				
				// If the date is like 1am or 1pm
				
				if (strlen($date) == 3)
				{
					
					$am_pm =  strtolower(substr($date, -2));
					$day = substr($date, 0, 1);
					
					if (is_numeric($day) && ($am_pm == 'am' or $am_pm == 'pm') )
					{
						$is_sat_sun = $CI->Helps->is_sat_sun($this->month, $day, $this->year);
					
						$is_holiday = $CI->Holiday->is_holiday($this->year.'-'.$this->month.'-'.$day);
						
						if ($is_sat_sun == 'Saturday' or $is_sat_sun == 'Sunday' or $is_holiday == TRUE)
						{
							// If allow sat or sun
							if ( $this->allow_sat_sun == 1)
							{
								$this->date_process[] = $this->year.'-'.$this->month.'-'.$day.' '.$am_pm;
								$this->count_leave += 0.5;
							}
						}
						else
						{
							$this->date_process[] = $this->year.'-'.$this->month.'-'.$day.' '.$am_pm;
							$this->count_leave += 0.5;
						}
						
					}
					
				}
				
				// If the date is like 10am or 12pm
				
				if (strlen($date) == 4)
				{
					$am_pm =  strtolower(substr($date, -2));
					$day = substr($date, 0, 2);
					
					if (is_numeric($day) && ($am_pm == 'am' or $am_pm == 'pm') )
					{
						$is_sat_sun = $CI->Helps->is_sat_sun($this->month, $day, $this->year);
					
						$is_holiday = $CI->Holiday->is_holiday($this->year.'-'.$this->month.'-'.$day);
						
						if ($is_sat_sun == 'Saturday' or $is_sat_sun == 'Sunday' or $is_holiday == TRUE)
						{
							// If allow sat or sun
							if ( $this->allow_sat_sun == 1)
							{
								$this->date_process[] = $this->year.'-'.$this->month.'-'.$day.' '.$am_pm;
								$this->count_leave += 0.5;
							}
						}
						else
						{
							$this->date_process[] = $this->year.'-'.$this->month.'-'.$day.' '.$am_pm;
							$this->count_leave += 0.5;
						}
						
						
					}
				}
			}	
			
		}
	}
	
	
}
