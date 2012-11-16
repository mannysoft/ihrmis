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
class Home extends MX_Controller  
{
	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		//$this->output->enable_profiler(TRUE);
		//$this->load->driver('my_driver');
		//$this->my_driver->my_driver_subclass->cool();
		
		//$this->load->spark('datamapper/1.8.2');
		
		//$this->load->spark('gas/2.1.1');
		
		
		
		//$this->ci_alerts->set('error', 'hehe');
		
		//echo $this->ci_alerts->display();
		
		//$this->load->library('zkemkeeper');
		
		//$this->zkemkeeper->connect();
		
		
		//echo $this->session->sess_expiration;
		
		
    }  
	
	// --------------------------------------------------------------------
	
	function index()
	{
		
		$this->is_user_logged($isUserLogged);
	}
	
	function sample()
	{
		echo 'sample';
		echo '<input type="button" onclick="parent.close()"></input>';
	}
	
	// --------------------------------------------------------------------
	
	function is_user_logged($isUserLogged = FALSE)
	{
		if ($isUserLogged == FALSE)
		{
			redirect('login/show_login', 'refresh');
		}
	}
	
	// --------------------------------------------------------------------
	
	function home_page()
	{
		
		//$this->load->library('MPDF52/mpdf');
				
		//$this->mpdf->WriteHTML('<p>Hello There hahahaha</p>');
				
		//$this->mpdf->Output('mpdf.pdf','I'); 
		
		//print_r($dates);
		
		
		
		
		$data = array();
		
		$data['msg'] = '';
		
		$data['page_name'] = 'Home';
		
		//Get the current ip of the machine
		$data['ip'] = $this->Stand_alone->current_ip();
		
		//set the delete logs from machine to no
		$this->Stand_alone->change_delete_status('no');
		
		//=========================================================================
		
		//Earn the leave credits if not yet earned
		$month = date('m');
		$year = date('Y');
		
		$isLastDayOfMonth   =  $this->Helps->is_last_day($month, $year, date('d'));
		
		$isLeaveMonthEarned = $this->Leave_earn_sched->is_leave_month_earned($month, $year);
		
		//Last day of the month
		$lastDayOfMonth 	= $this->Helps->get_last_day($month, $year);
		
		//Determine if the last day of the month is Saturday or sunday or Holiday
		$isSaturdaySunday 	= $this->Helps->is_sat_sun($month, $lastDayOfMonth, $year);
		
		//Determimine if last day of the month is holiday
		$isHoliday 		  	= $this->Holiday->is_holiday($year.'-'.$month.'-'.$lastDayOfMonth);
		
		//If the last day is Sat or sun or Holiday
		if ($isSaturdaySunday == 'Saturday' || $isSaturdaySunday == 'Sunday' || $isHoliday == TRUE)
		{
			$data['msg'] = 'The last day of the month is Saturday/Sunday/Holiday.<br>';
			$data['msg'] .='The earnings of leave credits is always scheduled every last day <br>';
			$data['msg'] .= 'of every month.<br>';
			$data['msg'] .= 'We are going to schedule the earning of leave credits on the last friday of this month.<br>';
			
			
			$lastfriday = strtotime( "last Friday", mktime( 0, 0, 0, date( "n" ) + 1, 1 ));
			
			$theLastFriday =  date('Y-m-d', $lastfriday);
			
			$today = date('Y-m-d');
			
			//If the last friday is equal to the date of today
			if ($theLastFriday == $today)
			{
				if ($isLeaveMonthEarned == FALSE)
				{
					//echo '<div id="mydiv"><img src="images/progress.gif"> Please wait... Leave earning on progress...</div>';
					//$Leave->process_leave_earnings($month, $year);
				}
			}
		
		}
		
		
		//if click the Perform leave earnings Now!
		if (isset($_GET['perform_leave']) && $_GET['perform_leave'] == 1)
		{
			echo '<div id="mydiv"><img src="images/progress.gif"> Please wait... Leave earning on progress...</div>';
			$Leave->process_leave_earnings($_GET['month'], $_GET['year'], $_GET['leave_earn']);
			echo '<script>alert("Done leave earnings!")</script>';
			echo '<script>window.location = "index.php?q=8"</script>';
		}

				
		$data['main_content'] = 'home';
		
		$this->load->view('includes/template', $data);
	}
}

/* End of file home.php */
/* Location: ./system/application/modules/home/controllers/home.php */