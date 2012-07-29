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
class Utility extends CI_Model {

	//use for line colors
	public $x = 2;
	public $y = 1;
	
	function __construct()
	{
		parent::__construct();
		
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	}

	/**
	 * Use this for line colors
	 *
	 * @return unknown
	 */
	function set_line_colors()
	{
		if($this->x > $this->y)
		{
			$this->y+=2;
			$bg="#F2F2F2";
		
		}else{
			
			$this->x+=2;
			$bg="#Ffffff";
		}
		
		return $bg;
	}
	
	/**
	 * Enter description here...
	 *
	 */
	function session()
	{
		session_start();
		
		if(!session_is_registered("username"))
		{
			header("location:login.php");
			exit;
		}
	
	}
	
	/**
	 * This function use for leave management
	 * get the year and month of two dates
	 * 
	 *
	 * @param unknown_type $date1
	 * @param unknown_type $date2
	 * @return array
	 */
	function get_months($date1, $date2) {
	   $time1  = strtotime($date1);
	   $time2  = strtotime($date2);
	   $my     = date('mY', $time2);
	
	   $months = array(date('Y-m', $time1));
	   $f      = '';
	
	   while($time1 < $time2) {
	      $time1 = strtotime((date('Y-m-d', $time1).' +15days'));
	      if(date('Y-m', $time1) != $f) {
	         $f = date('Y-m', $time1);
	         if(date('mY', $time1) != $my && ($time1 < $time2))
	            $months[] = date('Y-m', $time1);
	      }
	   }
	
	   $months[] = date('Y-m', $time2);
	   return $months;
	}
	
	/**
	 * determine if the date is saturday or sunday
	 *
	 * @param unknown_type $month
	 * @param unknown_type $day
	 * @param unknown_type $year
	 * @return unknown
	 */
	function is_sat_sun($month, $day, $year)
	{
		$dayName = date("l", mktime(0, 0, 0, $month, $day, $year));
		
		return $dayName;
	}
	
	/**
	 * Cut the office name into two if the lines is long
	 *
	 * @param unknown_type $cadena
	 * @param unknown_type $char_no
	 * @return unknown
	 */
	function splitstroverflow($cadena,$char_no) 
	{
		$pri_renglon = array();
		$seg_renglon = array();
		$palabras = explode(" ",trim($cadena));
	       
		for ($i = 0; $i < count($palabras); $i++) 
		{
			$sum += strlen($palabras[$i])+1;
			if ($sum >= $char_no) $seg_renglon[] = $palabras[$i] . " ";
			else $pri_renglon[] = $palabras[$i] . " ";
		}
			   
		for ($i = 0; $i < count($pri_renglon); $i++)
			$renglones[0] .= $pri_renglon[$i];
				   
		for ($i = 0; $i < count($seg_renglon); $i++)
			$renglones[1] .= $seg_renglon[$i];
			   
		return $renglones;
	}
	
	function set_font_red($log, $time, $isLogPm)
	{
		if ($isLogPm == TRUE) 
		{
			if ($log > $time)
			{
				//Check if log is in 12:00
				if (strtotime($log) > strtotime('12:00'))
				{
					return $log;
				}
				
				else 
				{
					return '<b><font color=red>'.$log.'</font></b>';
				}
			}
		}
		
		if ($log > $time)
		{
			
			if ($log == 'Official Business' OR $log =='Leave')
			{
				return $log;
			}
		
			return '<b><font color=red>'.$log.'</font></b>';
		}
		
		else 
		{
			return $log;
		}
		
	}
	
	/**
	 * Get the dates between two dates
	 *
	 * @param unknown_type $date1
	 * @param unknown_type $date2
	 * @return unknown
	 */
	function days_between($date1, $date2)
	{
	    $d1 = explode("-", $date1);
	    $d2 = explode("-", $date2);
	  
	    $year1 = $d1[0];
	    $month1 = $d1[1];
	    $day1 = $d1[2];
	
	    $year2 =  $d2[0];
	    $month2 = $d2[1];
	    $day2 = $d2[2];
	   
	    $deadline1 = mktime(0, 0, 0, $month1, $day1, $year1, 0);
	    $deadline2 = mktime(0, 0, 0, $month2, $day2, $year2, 0);
	    $res = round( ($deadline2 - $deadline1) / (60 * 60 * 24) );
	    return $res;
	}
	
	/**
	 * Footer
	 *
	 */
	function footer()
	{
		$Settings = new Settings();
		
		$settings = $Settings->settings();
		
		echo $settings['system_name'];
	
	}
	
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $bigTime
	 * @param unknown_type $smallTime
	 * @return unknown
	 */
	function diffTime($bigTime,$smallTime)
	{
	//input format hh:mm:ss
	
	        list($h1,$m1,$s1)=explode(":",$bigTime);
	        list($h2,$m2,$s2)=explode(":",$smallTime);
	       
	        $second1=$s1+($h1*3600)+($m1*60);//converting it into seconds
	        $second2=$s2+($h2*3600)+($m2*60);
	       
	       
	        if ($second1==$second2)
	        {
	            $resultTime="00:00:00";
	            return $resultTime;
	            exit();
	        }
	       
	       
	       
	        if ($second1<$second2) //
	        {
	            $second1=$second1+(24*60*60);//adding 24 hours to it.
	        }
	       
	       
	       
	        $second3=$second1-$second2;
	       
	        //print $second3;
	        if ($second3==0)
	        {
	            $h3=0;
	        }
	        else
	        {
	            $h3=floor($second3/3600);//find total hours
	        }
	           
	        $remSecond=$second3-($h3*3600);//get remaining seconds
	        if ($remSecond==0)
	        {
	            $m3=0;
	        }
	        else
	        {
	            $m3=floor($remSecond/60);// for finding remaining  minutes
	        }
	           
	        $s3=$remSecond-(60*$m3);
	       
	        if($h3==0)//formating result.
	        {
	            $h3="00";
	        }
	        if($m3==0)
	        {
	            $m3="00";
	        }
	        if($s3==0)
	        {
	            $s3="00";
	        }
	           
	        $resultTime="$h3:$m3";
	       
	       
	        return $resultTime;
	
	}
	
	/**
	 * Get month name
	 *
	 * @param unknown_type $month
	 * @return unknown
	 */
	function get_month_name($month)
	{
		switch($month)
		{
	    case "01" :
	       	$month = "January";
			break;
	    case "02" :
	       $month = "February";
			break;
	   	case "03" :
	        $month = "March";
			break;
	    case "04" :
	        $month = "April";
			break;
	    case "05" :
	        $month = "May";
			break;
	    case "06" :
	        $month = "June";
			break;
	    case "07" :
	        $month = "July";
			break;
	    case "08" :
	        $month = "August";
			break;
	    case "09" :
	        $month = "September";
			break;
	    case "10" :
	        $month = "October";
			break;
	    case "11" :
	        $month = "November";
			break;
	    case "12" :
	        $month = "December";
			break;
		} 
		
		return $month;
	}
	
	/**
	 * Get the time late (time_log is the employee time, must_log is the time must log
	 *
	 * @param unknown_type $am_login
	 * @param unknown_type $time_a
	 * @param unknown_type $pm_login
	 * @param unknown_type $time_c
	 * @return unknown
	 */
	function check_late($am_login, $time_a, $pm_login, $time_c)
	{
		
		
		$late['hours'] = 0;
		$late['count'] = 0;
		
		//For tardiness use
		$late['am_login'] = 0;
		$late['pm_login'] = 0;
		
		
		//am login
		if($am_login!="")
		{
			
			if(($am_login=="Official Business") || ($am_login=="Leave") || ($am_login=="CTO"))
			{	
				
				return $late;
			
			}
			
			if($am_login > $time_a)
			{
				$late['hours'] += strtotime($am_login) - strtotime($time_a);
				$late['count'] += 1;
				
				//For tardiness use
				$late['am_login'] = strtotime($am_login) - strtotime($time_a);
				
			}
		}
		
		
		
		if($pm_login!="")
		{
			//echo $time_c;
			if(($pm_login=="Official Business") || ($pm_login=="Leave") || ($pm_login=="CTO"))
			{	
				return $late;
			}
			
			if($pm_login > $time_c)
			{
				//if the time is greater than 12. meaning not late
				if(strtotime($pm_login) > strtotime('12:00'))
				{
					$late['hours'] += 0;
					$late['count'] += 0;
				}
				
				else{
				
					$late['hours'] += strtotime($pm_login) - strtotime($time_c) ;
					$late['count'] += 1;//problem
					
					//For tardiness use
					$late['pm_login'] = strtotime($pm_login) - strtotime($time_c);
				}
			}
		}
		
		
		return $late;
	}
	
	
	/**
	 * Check for undertime
	 *
	 * @param unknown_type $am_logout
	 * @param unknown_type $time_b
	 * @param unknown_type $pm_logout
	 * @param unknown_type $time_d
	 * @return unknown
	 */
	function check_undertime($am_logout, $time_b, $pm_logout, $time_d)
	{
		$undertime['hours'] = 0;
		$undertime['count'] = 0;
		
		//For tardiness use
		$undertime['am_logout'] = 0;
		$undertime['pm_logout'] = 0;
		
		//am logout
		if($am_logout!="")
		{
			
			if($am_logout=="Official Business" || $am_logout=="Leave" || $am_logout=="CTO")
			{
				return $undertime;
			}
		
			if($am_logout < $time_b)
			{
				$undertime['hours'] += strtotime($time_b) - strtotime($am_logout);
				$undertime['count'] += 1;
				
				//For tardiness use
				$undertime['am_logout'] = strtotime($time_b) - strtotime($am_logout);
			
			}
		}
		
		//pm logout
		if($pm_logout!="")
		{
			if($pm_logout=="Official Business" || $pm_logout=="Leave" || $pm_logout=="CTO")
			{
				return $undertime;
			}
			
			if($pm_logout < $time_d)
			{
				$undertime['hours'] += strtotime($time_d) - strtotime($pm_logout);
				$undertime['count'] += 1;
				
				//For tardiness use
				$undertime['pm_logout'] = strtotime($time_d) - strtotime($pm_logout);
			
			}
		}
		
		
		return $undertime;
	}
	
	
	/**
	 * COUNT HOURS WORKED
	 *
	 * @param unknown_type $login
	 * @param unknown_type $logout
	 * @return unknown
	 */
	function count_hours_work($login, $logout)
	{
		
		if($login!="" && $logout!="")
		{
			if($login > "12:00")
			{
				$logout = strtotime($logout) - strtotime('00:00');
				$login  = strtotime($login) - strtotime('12:00');
				return $logout - $login;
				//$a=strtotime($login) - strtotime('12:00');
				//return strtotime($logout) - $a;
				//return  strtotime($logout) - (strtotime($login) - strtotime('12:00'));
				//return strtotime($logout) - $login;
			}
			else{
			
				return 	strtotime($logout) - strtotime($login);
			}	
		}
	
	}
	
	/**
	 * THIS IS FOR 8 HOURS STRAIGHT
	 * Get the time late
	 *
	 * @param unknown_type $date_log
	 * @param unknown_type $time_log
	 * @param unknown_type $must_log
	 * @param unknown_type $am_or_pm
	 * @param unknown_type $must_am_or_pm
	 * @return unknown
	 */
	function check_late_8hrs( $date_log, $time_log, $must_log, $am_or_pm, $must_am_or_pm )
	{
		$late['hours'] = 0;
		$late['count'] = 0;
		
		//am login
		if ($time_log!="")
		{
			if ($time_log > $must_log)
			{
				
				if ($time_log >= '12:00')
				{
					if ($am_or_pm==$must_am_or_pm)
					{
						$late['hours'] += 0;
						$late['count'] += 0;
					}
				
				}
				
				else{
					$late['hours'] += strtotime($time_log) - strtotime($must_log);
					$late['count'] += 1;
				}
			}
			
			if ($time_log < $must_log)
			{
				if ($am_or_pm!=$must_am_or_pm)
				{
					$late['hours'] += strtotime($time_log) - strtotime('00:00');
					$late['hours'] += strtotime('12:00') - strtotime($must_log);
					
					$late['count'] += 1;
				}
			}
		}
		
		
		return $late;
	}
	
	/**
	 * THIS IS FOR 8 HOURS STRAIGHT
	 * check for under time
	 *
	 * @param unknown_type $date_log
	 * @param unknown_type $time_log
	 * @param unknown_type $must_log
	 * @param unknown_type $am_or_pm
	 * @param unknown_type $must_am_or_pm
	 * @return unknown
	 */
	function check_undertime_8hrs($date_log, $time_log, $must_log, $am_or_pm, $must_am_or_pm)
	{
		$undertime['hours'] = 0;
		$undertime['count'] = 0;
		
		//LOGOUT
		if($time_log!="")
		{
			if($time_log < $must_log)
			{
				$undertime['hours'] += strtotime($must_log) - strtotime($time_log);
				$undertime['count'] += 1;
			
			}
			
			if($time_log > $must_log)
			{
				
				
				if($time_log >= '12:00')
				{
				
					//if AM AND PM 
					if($am_or_pm!=$must_am_or_pm)
					{
						$undertime['hours'] += strtotime($must_log) - strtotime('00:00');
						$undertime['hours'] += strtotime('12:00') - strtotime($time_log);
						
						$undertime['count'] += 1;
					}
				
					//IF AM AND AM
					if($am_or_pm==$must_am_or_pm)
					{
						$temp = strtotime($must_log) - strtotime('00:00');
						$temp2 = strtotime($time_log) - strtotime('12:00');
						
						$undertime['hours'] += $temp - $temp2;
						$undertime['count'] += 1;
					}
				}
				
				else
				{
					if($am_or_pm!=$must_am_or_pm)
					{
						
						$undertime['hours'] += strtotime($must_log) - strtotime('00:00');
						$undertime['hours'] += strtotime('12:00') - strtotime($time_log);
						
						$undertime['count'] += 1;
					}
				
				}
			}
		}
		
		
		return $undertime;
	}
	
	/**
	 * THIS IS FOR 8 HOURS STRAIGHT
	 * COUNT HOURS WORKED
	 *
	 * @param unknown_type $login
	 * @param unknown_type $logout
	 * @param unknown_type $am_or_pm
	 * @param unknown_type $am_or_pm2
	 * @return unknown
	 */
	function count_hours_work_8hrs($login, $logout, $am_or_pm, $am_or_pm2)
	{
		if($login!="" && $logout!="")
		{
			if($logout < $login)
			{
				if($am_or_pm!=$am_or_pm2)
				{
					
					$logout = strtotime($logout) - strtotime('00:00');
					$login  = strtotime('12:00') - strtotime($login) ;
					return $logout + $login;
				
				}
			}
			
			if($logout > $login)
			{
				return strtotime($logout) - strtotime($login);
			}	
		}
	
	}
	
	/**
	 * THIS IS FOR 8 HOURS STRAIGHT 10pm to 6am
	 * Get the time late
	 *
	 * @param unknown_type $time_log
	 * @param unknown_type $must_log
	 * @param unknown_type $am_or_pm
	 * @param unknown_type $must_am_or_pm
	 * @return unknown
	 */
	function check_late_106( $time_log, $must_log, $am_or_pm, $must_am_or_pm )
	{
		$late['hours'] = 0;
		$late['count'] = 0;
		
		//pm login
		if($time_log!="")
		{
			if($time_log > $must_log)
			{
				
				if($time_log >= '12:00')
				{
					$late['hours'] += strtotime($time_log) - strtotime($must_log);
					$late['count'] += 1;
				}
				
				if($time_log < '12:00' )
				{
					$late['hours'] += strtotime($time_log) - strtotime($must_log);
					$late['count'] += 1;
				}
				
			}
			
			if($time_log < $must_log)
			{
				if($am_or_pm!=$must_am_or_pm)
				{
					$late['hours'] += strtotime($time_log) - strtotime('00:00');
					$late['hours'] += strtotime('12:00') - strtotime($must_log);
					
					$late['count'] += 1;
				}
			}
		}
		
		
		return $late;
	}
	
	/**
	 * THIS IS FOR 8 HOURS STRAIGHT 10pm to 6am
	 * Check for under time
	 *
	 * @param unknown_type $time_log
	 * @param unknown_type $must_log
	 * @param unknown_type $am_or_pm
	 * @param unknown_type $must_am_or_pm
	 * @return unknown
	 */
	function check_undertime_106($time_log, $must_log, $am_or_pm, $must_am_or_pm)
	{
		$undertime['hours'] = 0;
		$undertime['count'] = 0;
		
		//LOGOUT
		if($time_log!="")
		{
			if($time_log < $must_log)
			{
				$undertime['hours'] += strtotime($must_log) - strtotime($time_log);
				$undertime['count'] += 1;
			
			}
			
			if($time_log > $must_log)
			{
				
				
				if($time_log >= '12:00')
				{
					$temp = strtotime($must_log) - strtotime('00:00');
					$temp2 = strtotime($time_log) - strtotime('12:00');
					
					$undertime['hours'] += $temp - $temp2;
					$undertime['count'] += 1;
					
				}
				
			}
		}
		
		
		return $undertime;
	}
	
	/**
	 * THIS IS FOR 24 HOURS STRAIGHT
	 * Get the time late
	 *
	 * @param unknown_type $time_log
	 * @param unknown_type $must_log
	 * @param unknown_type $am_or_pm
	 * @param unknown_type $must_am_or_pm
	 * @return unknown
	 */
	function check_late_24( $time_log, $must_log, $am_or_pm, $must_am_or_pm )
	{
		$late['hours'] = 0;
		$late['count'] = 0;
		
		if($time_log!="")
		{
			if($time_log > $must_log)
			{
				
				if($time_log >= '12:00')
				{
					$late['hours'] += strtotime($time_log) - strtotime($must_log);
					$late['count'] += 1;
				}
				
				if($time_log < '12:00' )
				{
					$late['hours'] += strtotime($time_log) - strtotime($must_log);
					$late['count'] += 1;
				}
				
			}
			
			if($time_log < $must_log)
			{
				if($am_or_pm!=$must_am_or_pm)
				{
					$late['hours'] += strtotime($time_log) - strtotime('00:00');
					$late['hours'] += strtotime('12:00') - strtotime($must_log);
					
					$late['count'] += 1;
				}
			}
		}
		
		
		return $late;
	}
	
	/**
	 * THIS IS FOR 24 HOURS STRAIGHT
	 * Check for under time
	 *
	 * @param unknown_type $time_log
	 * @param unknown_type $must_log
	 * @param unknown_type $am_or_pm
	 * @param unknown_type $must_am_or_pm
	 * @return unknown
	 */
	function check_undertime_24($time_log, $must_log, $am_or_pm, $must_am_or_pm)
	{
		$undertime['hours'] = 0;
		$undertime['count'] = 0;
		
		//LOGOUT
		if($time_log!="")
		{
			if($time_log < $must_log)
			{
				$undertime['hours'] += strtotime($must_log) - strtotime($time_log);
				$undertime['count'] += 1;
			
			}
			
			if($time_log > $must_log)
			{
				
				
				if($time_log >= '12:00')
				{
					$temp = strtotime($must_log) - strtotime('00:00');
					$temp2 = strtotime($time_log) - strtotime('12:00');
					
					$undertime['hours'] += $temp - $temp2;
					$undertime['count'] += 1;
					
				}
				
			}
		}
		
		
		return $undertime;
	}
	
	/**
	 * Check if the time is verified(if not no output will be on DTR
	 *
	 * @param unknown_type $ver
	 * @param unknown_type $time
	 * @return unknown
	 */
	function isTimeVerified($ver,$time)
	{
		if($ver==0)
		{
			return '';
		}
		
		else{
			$time;
		}
	
	}
	
	function is_ob($log)
	{
		if ($log == 'Official Business')
		{
			return 'OB';
		}
			
		else
		{
			return $log;
		}
			
	}
	
	/**
	 * Get extension of the filename
	 *
	 * @param unknown_type $filename
	 * @return unknown
	 */
	function find_exts($filename)
	{
		$filename = strtolower($filename) ;
		$exts = split("[/\\.]", $filename) ;
		$n = count($exts)-1;
		$exts = $exts[$n];
		return $exts;
	}
	
	/**
	 * Compute the time(minutes) and return depending the amount of minute(hr,min,sec)
	 *
	 * @param unknown_type $integer
	 * @return unknown
	 */
	function compute_time($integer) 
	{ 
	
	    $seconds=$integer; 
	
	    if ($seconds/60 >=1) 
	
	    { 
	
			$minutes=floor($seconds/60); 
		
			if ($minutes/60 >= 1) 
		
			{ # Hours 
		
				$hours=floor($minutes/60); 
			
				if ($days>=1 && $hours >=1) $return="$return"; 
			
				if ($hours >=2) $return="$return $hours hrs"; 
			
				if ($hours ==1) $return="$return $hours hr"; 
		
			} #end of Hours 
		
			$minutes=$minutes-(floor($minutes/60))*60; 
		
			if ($hours>=1 && $minutes >=1) $return="$return"; 
		
			if ($minutes >=2) $return="$return $minutes mins"; 
		
			if ($minutes ==1) $return="$return $minutes min"; 
		
	    } #end of minutes 
	
	    $seconds=$integer-(floor($integer/60))*60; 
	
	    if ($minutes>=1 && $seconds >=1) $return="$return"; 
	
	    if ($seconds >=2) $return="$return $seconds secs"; 
	
	    if ($seconds ==1) $return="$return $seconds sec"; 
	
	    $return="$return"; 
	
	    return $return; 
	
	}
	
	function compute_over_time($otIn, $otOut)
	{
		return 	strtotime($otOut) - strtotime($otIn);
		
		if($login!="" && $logout!="")
		{
			if($login > "12:00")
			{
				$logout = strtotime($logout) - strtotime('00:00');
				$login  = strtotime($login) - strtotime('12:00');
				return $logout - $login;
				//$a=strtotime($login) - strtotime('12:00');
				//return strtotime($logout) - $a;
				//return  strtotime($logout) - (strtotime($login) - strtotime('12:00'));
				//return strtotime($logout) - $login;
			}
			else{
			
				return 	strtotime($logout) - strtotime($login);
			}	
		}
	}
	
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $integer
	 * @return unknown
	 */
	function compute_hour_minute($integer) 
	{ 
	
	    $seconds=$integer; 
	
	    if ($seconds/60 >=1) 
	
	    { 
	
			$minutes=floor($seconds/60); 
		
			if ($minutes/60 >= 1) 
		
			{ # Hours 
		
				$hours=floor($minutes/60); 
			
				if ($days>=1 && $hours >=1) $return="$return"; 
			
				if ($hours >=2) $return="$return $hours,"; 
			
				if ($hours ==1) $return="$return $hours,"; 
		
			} #end of Hours 
		
			$minutes=$minutes-(floor($minutes/60))*60; 
		
			if ($hours>=1 && $minutes >=1) $return="$return"; 
		
			if ($minutes >=2) $return="$return $minutes"; 
		
			if ($minutes ==1) $return="$return $minutes"; 
		
	    } #end of minutes 
	
	    $seconds=$integer-(floor($integer/60))*60; 
	
	    if ($minutes>=1 && $seconds >=1) $return="$return"; 
	
	    if ($seconds >=2) $return="$return"; 
	
	    if ($seconds ==1) $return="$return"; 
	
	    $return="$return"; 
	
	    $minutes = $minutes/60;
		
		$hours += $minutes;
		
		return $hours/8; 
	
	}
	
	/**
	 * Compute Leave
	 *
	 * @param unknown_type $days_leave_v
	 * @param unknown_type $days_v
	 * @param unknown_type $L
	 * @return unknown
	 */
	function leave_compute($days_leave_v, $days_v , $L)
	{
		if($days_leave_v != 0)
		{
			$days_v = explode(",", $days_v);
			
			$the_same = 0;
			
			$start =  $days_v[0];
			
			$start_temp =  $days_v[0];
						
			$all = '';
			
			
			foreach($days_v as $day)
			{
				
				if( ($day - $start) == 1)
				{
					$temp_last = $day;
					$last_day_temp = $day;
					$start = $day;
					
				}
				
				else
				{
					
					
					if($day == $start)
					{
						$start = $day;
						
						$start_temp = $day;
						
						$last_day = $day;
						$last_day_temp = $day;
					}
					
					else{
						
						
						$dash = '';
						
						if($temp_last != "")
						{
							$dash = '-';
						}
						
						$all .= $start_temp.$dash.$temp_last.',';
						
						$start_temp = $day;
						
						$start = $day;
						
						$temp_last = '';
					}	
				}
			}
			
			//remove the comma in the var $all 
			$all = substr($all, 0, -1);
			
			$days_leave_v_and_days = $days_leave_v.$L.' '.$all;
		}
		
		return $days_leave_v_and_days;
	}
	
	/**
	 * Use for copying Folders
	 *
	 * @param unknown_type $source
	 * @param unknown_type $target
	 */
	function full_copy( $source, $target )
    {
        if ( is_dir( $source ) )
        {
            @mkdir( $target );
           
            $d = dir( $source );
           
            while ( FALSE !== ( $entry = $d->read() ) )
            {
                if ( $entry == '.' || $entry == '..' )
                {
                    continue;
                }
               
                $Entry = $source . '/' . $entry;           
                if ( is_dir( $Entry ) )
                {
                    full_copy( $Entry, $target . '/' . $entry );
                    continue;
                }
                copy( $Entry, $target . '/' . $entry );
            }
           
            $d->close();
        }else
        {
            copy( $source, $target );
        }
    }
    
    /**
     * Copying Folders
     *
     * @param unknown_type $srcdir
     * @param unknown_type $dstdir
     * @param unknown_type $offset
     * @param unknown_type $verbose
     * @return unknown
     */
    function dircopy($srcdir, $dstdir, $offset, $verbose = false) 
    {
		if(!isset($offset)) $offset=0;
		  $num = 0;
		  $fail = 0;
		  $sizetotal = 0;
		  $fifail = '';
		  if(!is_dir($dstdir)) mkdir($dstdir);
		  if($curdir = opendir($srcdir)) {
		    while($file = readdir($curdir)) {
		      if($file != '.' && $file != '..') {
		        $srcfile = $srcdir . '\\' . $file;
		        $dstfile = $dstdir . '\\' . $file;
		        if(is_file($srcfile)) {
		          if(is_file($dstfile)) $ow = filemtime($srcfile) - filemtime($dstfile); else $ow = 1;
		          if($ow > 0) {
		            if($verbose) echo "Copying '$srcfile' to '$dstfile'...";
		            if(copy($srcfile, $dstfile)) {
		              touch($dstfile, filemtime($srcfile)); $num++;
		              $sizetotal = ($sizetotal + filesize($dstfile));
		              if($verbose) echo "OK\n";
		            }
		            else {
		                 echo "Error: File '$srcfile' could not be copied!\n";
		                 $fail++;
		                 $fifail = $fifail.$srcfile."|";
		            }
		          }                  
		        }
		        else if(is_dir($srcfile)) {
		          $res = explode(",",$ret);
		          $ret = dircopy($srcfile, $dstfile, $verbose);
		          $mod = explode(",",$ret);
		          $imp = array($res[0] + $mod[0],$mod[1] + $res[1],$mod[2] + $res[2],$mod[3].$res[3]);
		          $ret = implode(",",$imp);
		        }
		      }
		    }
		    closedir($curdir);
		  }
		  $red = explode(",",$ret);
		  $ret = ($num + $red[0]).",".(($fail-$offset) + $red[1]).",".($sizetotal + $red[2]).",".$fifail.$red[3];
		  return $ret;
	}
	
	/**
	 * Dump data and structure from MySQL database
	 *
	 * @param string $database
	 * @return string
	 * @example
 	 *
 	 * $dump = new BACKUP();
 	 * print $dump->dumpDatabase("mydb");
	 */
	function dumpDatabase($database) {

		ini_set('max_execution_time',300);
		// Set content-type and charset
		header ('Content-Type: text/html; charset=iso-8859-1');

		// Connect to database
		$db = mysql_select_db($database);

		if (!empty($db)) {

			// Get all table names from database
			$c = 0;
			$result = mysql_list_tables($database);
			for($x = 0; $x < mysql_num_rows($result); $x++) {
			
				$table = mysql_tablename($result, $x);
				//echo $table.'<br>';
				if (!empty($table)) {
					$arr_tables[$c] = mysql_tablename($result, $x);
					$c++;
				}
			}

			// List tables
			$dump = "DROP SCHEMA IF EXISTS $database; \nCREATE DATABASE $database; \nUSE $database; \n";
			for ($y = 0; $y < count($arr_tables); $y++){

				// DB Table name
				$table = $arr_tables[$y];
				// Structure Header
				$structure .= "-- \n";
				$structure .= "-- Table structure for table `{$table}` \n";
				$structure .= "-- \n\n";

				// Dump Structure
				$structure .= "DROP TABLE IF EXISTS `{$table}`; \n";
				$structure .= "CREATE TABLE `{$table}` (\n";
				$result = mysql_db_query($database, "SHOW FIELDS FROM `{$table}`");
				while($row = mysql_fetch_object($result)) {

					$structure .= "  `{$row->Field}` {$row->Type}";
					$structure .= (!empty($row->Default)) ? " DEFAULT '{$row->Default}'" : false;
					$structure .= ($row->Null != "YES") ? " NOT NULL" : false;
					$structure .= (!empty($row->Extra)) ? " {$row->Extra}" : false;
					$structure .= ",\n";

				}

				$structure = ereg_replace(",\n$", "", $structure);

				// Save all Column Indexes in array
				unset($index);
				$result = mysql_db_query($database, "SHOW KEYS FROM `{$table}`");
				while($row = mysql_fetch_object($result)) {

					if (($row->Key_name == 'PRIMARY') AND ($row->Index_type == 'BTREE')) {
						$index['PRIMARY'][$row->Key_name] = $row->Column_name;
					}

					if (($row->Key_name != 'PRIMARY') AND ($row->Non_unique == '0') AND ($row->Index_type == 'BTREE')) {
						$index['UNIQUE'][$row->Key_name] = $row->Column_name;
					}

					if (($row->Key_name != 'PRIMARY') AND ($row->Non_unique == '1') AND ($row->Index_type == 'BTREE')) {
						$index['INDEX'][$row->Key_name] = $row->Column_name;
					}

					if (($row->Key_name != 'PRIMARY') AND ($row->Non_unique == '1') AND ($row->Index_type == 'FULLTEXT')) {
						$index['FULLTEXT'][$row->Key_name] = $row->Column_name;
					}

				}
				
				//
				// Return all Column Indexes of array
				if (is_array($index)) {
					foreach ($index as $xy => $columns) {

						$structure .= ",\n";

						$c = 0;
						foreach ($columns as $column_key => $column_name) {

							$c++;

							$structure .= ($xy == "PRIMARY") ? "  PRIMARY KEY  (`{$column_name}`)" : false;
							$structure .= ($xy == "UNIQUE") ? "  UNIQUE KEY `{$column_key}` (`{$column_name}`)" : false;
							$structure .= ($xy == "INDEX") ? "  KEY `{$column_key}` (`{$column_name}`)" : false;
							$structure .= ($xy == "FULLTEXT") ? "  FULLTEXT `{$column_key}` (`resolution_no`,`subject`,`series`,`author`)
" : false;
							//echo $column_key.'<br>';//wala ito dati
							$structure .= ($c < (count($index[$xy]))) ? ",\n" : false;

						}
						//put here the other key 
						//$structure .='hahaha';

					}

				}

				$structure .= "\n) ENGINE = MYISAM ;\n\n";

				// Header
				$structure .= "-- \n";
				$structure .= "-- Dumping data for table `$table` \n";
				$structure .= "-- \n\n";

				// Dump data
				//$data='';
				unset($data);//currently uncomment
				$result     = mysql_query("SELECT * FROM `$table`");
				$num_rows   = mysql_num_rows($result);
				$num_fields = mysql_num_fields($result);

				for ($i = 0; $i < $num_rows; $i++) {

					$row = mysql_fetch_object($result);
					$data .= "INSERT INTO `$table` (";

					// Field names
					for ($x = 0; $x < $num_fields; $x++) {

						$field_name = mysql_field_name($result, $x);

						$data .= "`{$field_name}`";
						$data .= ($x < ($num_fields - 1)) ? ", " : false;

					}

					$data .= ") VALUES (";

					// Values
					for ($x = 0; $x < $num_fields; $x++) {
						$field_name = mysql_field_name($result, $x);

						$data .= "'" . str_replace('\"', '"', mysql_escape_string($row->$field_name)) . "'";
						$data .= ($x < ($num_fields - 1)) ? ", " : false;

					}

					$data.= ");\n";
				}

				$data.= "\n";

				$dump .= $structure . $data;
				$dump .= "-- --------------------------------------------------------\n\n";
				$structure='';
				$the_data.=$data;

			}

			return $dump;
			//return $structure;
			//return $data;
			//return $the_data;

		}

	}
	
	/**
	 * Restoration of database from sql files
	 *
	 * @param unknown_type $filename
	 * @example
	 * 
	 * $restore = new BACKUP();
 	 * print $restore->restoreDatabase('backup/'.$file);
	 */
	function restoreDatabase($filename)
	{
		ini_set('max_execution_time',300);
		// Temporary variable, used to store current query
		$templine = '';
		// Read in entire file
		$lines = file($filename);
		// Loop through each line
		foreach ($lines as $line_num => $line) 
		{
		  // Only continue if it's not a comment
		  if (substr($line, 0, 2) != '--' && $line != '') 
		  {
			// Add this line to the current segment
			$templine .= $line;
			// If it has a semicolon at the end, it's the end of the query
			if (substr(trim($line), -1, 1) == ';') 
			{
			  // Perform the query
			  mysql_query($templine);// or print('Error performing query \'<b>' . $templine . '</b>\': ' . mysql_error() . '<br /><br />');
			  // Reset temp variable to empty
			  $templine = '';
			}
		  }
		}
	}
	
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $string
	 * @return unknown
	 */
	function encoded($string)
	{   
		$sesencoded = $string;
		$num = mt_rand(3,9);
		for($i=1;$i<=$num;$i++)
		{
			 $sesencoded =
			 base64_encode($sesencoded);
		}
		$alpha_array =
		array('Y','D','U','R','P',
		'S','B','M','A','T','H');
		$sesencoded =
		$sesencoded."+".$alpha_array[$num];
		$sesencoded =
		base64_encode($sesencoded);
		
		return $sesencoded;
	}//end of encoded function 
	
	//function to decode string that encode by function encoded
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $string
	 * @return unknown
	 */
	function decoded($string)
	{
		$alpha_array =
		array('Y','D','U','R','P',
		'S','B','M','A','T','H');
		$decoded =
		base64_decode($string);
		list($decoded,$letter) =
		split("\+",$decoded);
		for($i=0;$i<count($alpha_array);$i++)
		{
			if($alpha_array[$i] == $letter)
			break;
		}
		for($j=1;$j<=$i;$j++)
		{
			$decoded =
			base64_decode($decoded);
		}
		return $decoded;
	}//end of decoded function
	
}
