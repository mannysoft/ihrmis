<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Attendance Tracking and Leave Management System
 *
 * An Application Software use by Government agencies for management
 * of employees Attendance and Leave Administration.
 *
 * @package		ATLMS
 * @author		Manolito Isles
 * @copyright	Copyright (c) 2008 - 2012, Charliesoft
 * @license		GNU GPL
 * @link		http://charliesoft.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * ATLMS Conversion Table Class
 *
 * This class use for converting number of minutes late
 * to the corresponding equivalent to leave credits.
 *
 * @package		ATLMS
 * @subpackage	Models
 * @category	Models
 * @author		Manolito Isles
 * @link		http://charliesoft.com/atlms/user_guide/models/conversion_table.html
 */
class Leave {

   	var $employee_id 		= '';
   	var $multiple 			= '';
	var $month 				= '';
	var $year  				= '';
	var $leave_type_id  	= '';
	var $month5  			= '';
	var $year5  			= '';
	var $multiple5  		= '';
	var $special_priv_id  	= '';
	var $days  				= '';
	var $mone  				= '';
	var $process  			= 0;
	
	var $date_process 		= array();
	var $count_leave 		= 0;
	var $invalid 			= '';
	
	var $dates				= array();
	var $action_taken		= '';
	var $max_date			= '';
	
	var $allow_sat_sun		= 0; // allow leave for saturday or sunday
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
		
		// Set to blank if the value is equal to zero
		
		if ($this->multiple == 0)
		{
			$this->multiple = '';
		}
		if ($this->multiple5 == 0)
		{
			$this->multiple5 = '';
		}
		if ($this->days == 0)
		{
			$this->days = '';
		}
		if ($this->mone == 0)
		{
			$this->mone = '';
		}
	}
	
	// ------------------------------------------------------------------------
	
	function is_employee($name = '')
	{
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
					echo '<font color="red">You are not allowed to view this records!</font>';
					return ;
				}
				
			}
			
			$pics = $name['pics'];
			
			if($name['pics']=="")
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
			
			//echo base_url().'pics/'.$name['pics'];
			
			echo '<center><img src="'.base_url().'pics/'.$pics.'" width="'.$w.'" height="'.$h.'" /></center><br>';
			//echo '<center><strong>'.utf8_encode($name['fname'].' '.$name['mname'].' '.$name['lname']).'</strong></center><br>';
			echo '<center><strong>'.$name['fname'].' '.$name['mname'].' '.$name['lname'].'</strong></center><br>';
			echo '<input name="taken" type="hidden" id="no_record" value="1" />';
			
			
			
			//=========
			$total_leave = $CI->Leave_card->get_total_leave_credits($this->employee_id);
			
			$vbalance =  $total_leave['vacation'];
			$sbalance =  $total_leave['sick'];
			//==========
			
			$total_leave_balance = $vbalance + $sbalance;
			
			$last_earn = $CI->Leave_card->get_last_earn($this->employee_id);
			
			//echo $last_earn;
			
			if ( $last_earn != '0000-00-00')
			{
				$last_earn = date('F d, Y', strtotime($last_earn));
			}
			else
			{
				$last_earn = date('F d, Y');
			}
			
			
			
			echo '<strong></strong> Leave Balances as of <b>'.$last_earn.'</b><br>';
			echo '<strong></strong> Vacation Leave Balance: <b>'.number_format($vbalance, 3).'</b><br>';
			echo '<strong></strong> Sick Leave Balance: <b>'.number_format($sbalance, 3).'</b><br>';
			echo '<strong></strong> Total Leave Balances: <b>'.number_format($total_leave_balance, 3).'</b><br>';
			echo '<strong></strong> MC#6 Balance: <b>'.$CI->Leave_card->get_mc_balance($this->employee_id, $this->year).'</b><br><br>';
			
			?>
			<br />View Leave Card <img src="<?php echo base_url();?>images/classevent_main.png" title="History" onClick="openBrWindow('<?php echo base_url();?>leave_manage/leave_card/<?php echo $this->employee_id;?>','','scrollbars=yes,width=900,height=600')" style="cursor: pointer;"/><br />
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
			
			$is_sat_sun = $CI->Helps->is_sat_sun($month, $day, $year);
			
			$is_holiday = $CI->Holiday->is_holiday($more_date);
			
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
					$this->date_process[] = $more_date;
					$this->count_leave += 1;
				}
			}
			else
			{
				$this->date_process[] = $more_date;
				$this->count_leave += 1;
			}
			
			
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
